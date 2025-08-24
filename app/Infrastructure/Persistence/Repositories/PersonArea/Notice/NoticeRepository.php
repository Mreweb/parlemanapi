<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\Notice;

use App\Domain\Interfaces\PersonArea\Notice\INoticeRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Notice\NoticeEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Notice\NoticeSignatureEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class NoticeRepository implements INoticeRepository
{

    public function list(array $filters)
    {
        $query = NoticeEloquent::query();
        $query->select(
            'notice_id',
            'notice_subject',
            'notice_president_id',
            'notice_gov_period_id',
            'notice_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'notice_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.notice_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.notice_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.notice_parliament_period_id');
        if (!empty($filters['notice_subject'])) {
            $query->where('notice_subject', 'like', '%' . $filters['notice_subject'] . '%');
        }
        if (!empty($filters['notice_president_id'])) {
            $query->where('notice_president_id', 'like', '%' . $filters['notice_president_id'] . '%');
        }
        if (!empty($filters['notice_gov_period_id'])) {
            $query->where('notice_gov_period_id', 'like', '%' . $filters['notice_gov_period_id'] . '%');
        }
        if (!empty($filters['notice_parliament_period_id'])) {
            $query->where('notice_parliament_period_id', 'like', '%' . $filters['notice_parliament_period_id'] . '%');
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
        $query = NoticeEloquent::query();
        $query->select(
            'person_notice.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'notice_session_number',
            'person_notice.created_at',
            'person_notice.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_notice.notice_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_notice.notice_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_notice.notice_parliament_period_id');
        $query->where('notice_id', $id);
        $result = $query->get()->toArray();
        $result[0]['person_notice_signature'] = $this->findSinaturesById($result[0]['notice_id']);
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['notice_id'], (new NoticeEloquent()->getTable()));
        return $result;
    }

    public function findSinaturesById(int $id)
    {
        $query = NoticeSignatureEloquent::query();
        return $query->select('notice_person_id as person_id')->where('notice_id', $id)->get()->toArray();
    }

    public function create(array $data)
    {

        return DB::transaction(function () use ($data) {

            $notice_signature_person_ids = $data['notice_signature_person_ids'];
            unset($data['notice_signature_person_ids']);
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = NoticeEloquent::create($data);
            foreach ($notice_signature_person_ids as $notice_signature_person_id) {
                NoticeSignatureEloquent::create(
                    [
                        'notice_id' => $result->notice_id,
                        'notice_person_id' => $notice_signature_person_id
                    ]
                );
            }
            (new UploadRepository())->add_attachments($attachments, (new NoticeEloquent()->getTable()), $result->notice_id);

            return $result;

        });


    }

    public function update(array $data){


        return DB::transaction(function () use ($data) {
            $notice_signature_person_ids = $data['notice_signature_person_ids'];
            unset($data['notice_signature_person_ids']);
            $attachments = $data['attachments'];
            unset($data['attachments']);

            $result = NoticeEloquent::where('notice_id', $data['notice_id'])->update(
                $data
            );

            NoticeSignatureEloquent::where('notice_id', $data['notice_id'])->delete();
            foreach ($notice_signature_person_ids as $notice_signature_person_id) {
                NoticeSignatureEloquent::create(
                    [
                        'notice_id' => $data['notice_id'],
                        'notice_person_id' => $notice_signature_person_id
                    ]
                );
            }
            (new UploadRepository())->add_attachments($attachments, (new NoticeEloquent()->getTable()), $data['notice_id']);

            return $result;
        });
    }

    public function delete(int $id)
    {
        $city = $this->findById($id);
        if ($city) {
            return NoticeEloquent::findOrFail($id)->delete();
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
