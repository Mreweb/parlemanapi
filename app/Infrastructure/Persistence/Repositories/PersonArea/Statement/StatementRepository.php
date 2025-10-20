<?php
namespace App\Infrastructure\Persistence\Repositories\PersonArea\Statement;
use App\Domain\Interfaces\PersonArea\Statement\IStatementRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Statement\StatementEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Statement\StatementSignatureEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class StatementRepository implements IStatementRepository{
    public function all(array $filters)
    {
        $query = StatementEloquent::query();
        $query->select(
            'statement_id',
            'statement_subject',
            'statement_president_id',
            'statement_gov_period_id',
            'statement_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'statement_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.statement_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.statement_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.statement_parliament_period_id');
        if (!empty($filters['statement_subject'])) {
            $query->where('statement_subject', 'like', '%' . $filters['statement_subject'] . '%');
        }
        if (!empty($filters['statement_president_id'])) {
            $query->where('statement_president_id', 'like', '%' . $filters['statement_president_id'] . '%');
        }
        if (!empty($filters['statement_gov_period_id'])) {
            $query->where('statement_gov_period_id', 'like', '%' . $filters['statement_gov_period_id'] . '%');
        }
        if (!empty($filters['statement_parliament_period_id'])) {
            $query->where('statement_parliament_period_id', 'like', '%' . $filters['statement_parliament_period_id'] . '%');
        }
        $data['count'] = $query->count();
        $data['list'] = $query->get();
        return $data;
    }
    public function list(array $filters)
    {
        $query = StatementEloquent::query();
        $query->select(
            'statement_id',
            'statement_subject',
            'statement_president_id',
            'statement_gov_period_id',
            'statement_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'statement_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.statement_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.statement_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.statement_parliament_period_id');
        if (!empty($filters['statement_subject'])) {
            $query->where('statement_subject', 'like', '%' . $filters['statement_subject'] . '%');
        }
        if (!empty($filters['statement_president_id'])) {
            $query->where('statement_president_id', 'like', '%' . $filters['statement_president_id'] . '%');
        }
        if (!empty($filters['statement_gov_period_id'])) {
            $query->where('statement_gov_period_id', 'like', '%' . $filters['statement_gov_period_id'] . '%');
        }
        if (!empty($filters['statement_parliament_period_id'])) {
            $query->where('statement_parliament_period_id', 'like', '%' . $filters['statement_parliament_period_id'] . '%');
        }
        $data['count'] = $query->count();
        if (!empty($filters['page_index'])) {
            $query->skip(--$filters['page_index'] * $filters['page_size']);
        }
        if (!empty($filters['page_size'])) {
            $query->take($filters['page_size']);
        }
        $data['list'] = $query->get();
        return $data;
    }
    public function findById(int $id)
    {
        $query = StatementEloquent::query();
        $query->select(
            'person_notice.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'statement_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.statement_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.statement_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.statement_parliament_period_id');
        $query->where('statement_id', $id);
        $result = $query->get()->toArray();
        if(!isset($result[0])){
            return [];
        }
        $result[0]['person_statement_signature'] = $this->findSinaturesById($result[0]['statement_id']);
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['statement_id'], (new StatementEloquent()->getTable()));
        return $result;
    }
    public function findSinaturesById(int $id)
    {
        $query = StatementSignatureEloquent::query();
        return $query->select('statement_person_id as person_id')->where('statement_id', $id)->get()->toArray();
    }
    public function create(array $data)
    {

        return DB::transaction(function () use ($data) {

            $statement_signature_person_ids = $data['statement_signature_person_ids'];
            unset($data['statement_signature_person_ids']);
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = StatementEloquent::create($data);
            foreach ($statement_signature_person_ids as $statement_signature_person_id) {
                StatementSignatureEloquent::create(
                    [
                        'statement_id' => $result->statement_id,
                        'statement_person_id' => $statement_signature_person_id
                    ]
                );
            }
            (new UploadRepository())->add_attachments($attachments, (new StatementEloquent()->getTable()), $result->statement_id);

            return $result;

        });


    }
    public function update(array $data){


        return DB::transaction(function () use ($data) {
            $statement_signature_person_ids = $data['statement_signature_person_ids'];
            unset($data['statement_signature_person_ids']);
            $attachments = $data['attachments'];
            unset($data['attachments']);

            $result = StatementEloquent::where('statement_id', $data['statement_id'])->update(
                $data
            );

            StatementSignatureEloquent::where('statement_id', $data['statement_id'])->delete();
            foreach ($statement_signature_person_ids as $statement_signature_person_id) {
                StatementSignatureEloquent::create(
                    [
                        'statement_id' => $data['statement_id'],
                        'statement_person_id' => $statement_signature_person_id
                    ]
                );
            }
            (new UploadRepository())->add_attachments($attachments, (new StatementEloquent()->getTable()), $data['statement_id']);

            return $result;
        });
    }
    public function delete(int $id)
    {
        $city = $this->findById($id);
        if ($city) {
            return StatementEloquent::findOrFail($id)->delete();
        } else {
            return false;
        }
    }
    public function findWorksheetMedia(int $id)
    {
        return (new UploadRepository())->get_file($id);
    }
    public function findAnswerWorksheetMedia(int $id)
    {
        return (new UploadRepository())->get_file($id);
    }
}
