<?php
namespace App\Infrastructure\Persistence\Repositories\PersonArea\Speech;
use App\Domain\Interfaces\PersonArea\Speech\ISpeechRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Speech\SpeechEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Speech\SpeechSignatureEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;
class SpeechRepository implements ISpeechRepository{
    public function all(array $filters)
    {
        $query = SpeechEloquent::query();
        $query->select(
            'speech_id',
            'speech_subject',
            'speech_president_id',
            'speech_gov_period_id',
            'speech_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'speech_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.speech_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.speech_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.speech_parliament_period_id');
        if (!empty($filters['speech_subject'])) {
            $query->where('speech_subject', 'like', '%' . $filters['speech_subject'] . '%');
        }
        if (!empty($filters['speech_president_id'])) {
            $query->where('speech_president_id', 'like', '%' . $filters['speech_president_id'] . '%');
        }
        if (!empty($filters['speech_gov_period_id'])) {
            $query->where('speech_gov_period_id', 'like', '%' . $filters['speech_gov_period_id'] . '%');
        }
        if (!empty($filters['speech_parliament_period_id'])) {
            $query->where('speech_parliament_period_id', 'like', '%' . $filters['speech_parliament_period_id'] . '%');
        }
        $data['count'] = $query->count();
        $data['list'] = $query->get();
        return $data;
    }
    public function list(array $filters)
    {
        $query = SpeechEloquent::query();
        $query->select(
            'speech_id',
            'speech_subject',
            'speech_president_id',
            'speech_gov_period_id',
            'speech_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'speech_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.speech_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.speech_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.speech_parliament_period_id');
        if (!empty($filters['speech_subject'])) {
            $query->where('speech_subject', 'like', '%' . $filters['speech_subject'] . '%');
        }
        if (!empty($filters['speech_president_id'])) {
            $query->where('speech_president_id', 'like', '%' . $filters['speech_president_id'] . '%');
        }
        if (!empty($filters['speech_gov_period_id'])) {
            $query->where('speech_gov_period_id', 'like', '%' . $filters['speech_gov_period_id'] . '%');
        }
        if (!empty($filters['speech_parliament_period_id'])) {
            $query->where('speech_parliament_period_id', 'like', '%' . $filters['speech_parliament_period_id'] . '%');
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
        $query = SpeechEloquent::query();
        $query->select(
            'person_notice.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'speech_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.speech_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.speech_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.speech_parliament_period_id');
        $query->where('speech_id', $id);
        $result = $query->get()->toArray();
        if(!isset($result[0])){
            return [];
        }
        $result[0]['person_speech_signature'] = $this->findSinaturesById($result[0]['speech_id']);
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['speech_id'], (new SpeechEloquent()->getTable()));
        return $result;
    }
    public function findSinaturesById(int $id)
    {
        $query = SpeechSignatureEloquent::query();
        return $query->select('speech_person_id as person_id')->where('speech_id', $id)->get()->toArray();
    }
    public function create(array $data)
    {

        return DB::transaction(function () use ($data) {

            $speech_signature_person_ids = $data['speech_signature_person_ids'];
            unset($data['speech_signature_person_ids']);
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = SpeechEloquent::create($data);
            foreach ($speech_signature_person_ids as $speech_signature_person_id) {
                SpeechSignatureEloquent::create(
                    [
                        'speech_id' => $result->speech_id,
                        'speech_person_id' => $speech_signature_person_id
                    ]
                );
            }
            (new UploadRepository())->add_attachments($attachments, (new SpeechEloquent()->getTable()), $result->speech_id);

            return $result;

        });


    }
    public function update(array $data){


        return DB::transaction(function () use ($data) {
            $speech_signature_person_ids = $data['speech_signature_person_ids'];
            unset($data['speech_signature_person_ids']);
            $attachments = $data['attachments'];
            unset($data['attachments']);

            $result = SpeechEloquent::where('speech_id', $data['speech_id'])->update(
                $data
            );

            SpeechSignatureEloquent::where('speech_id', $data['speech_id'])->delete();
            foreach ($speech_signature_person_ids as $speech_signature_person_id) {
                SpeechSignatureEloquent::create(
                    [
                        'speech_id' => $data['speech_id'],
                        'speech_person_id' => $speech_signature_person_id
                    ]
                );
            }
            (new UploadRepository())->add_attachments($attachments, (new SpeechEloquent()->getTable()), $data['speech_id']);

            return $result;
        });
    }
    public function delete(int $id)
    {
        $city = $this->findById($id);
        if ($city) {
            return SpeechEloquent::findOrFail($id)->delete();
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
