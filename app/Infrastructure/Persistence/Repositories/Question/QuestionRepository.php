<?php

namespace App\Infrastructure\Persistence\Repositories\Question;
use App\Domain\Interfaces\IQuestionRepository;
use App\Infrastructure\Persistence\Eloquent\Question\QuestionEloquent;
use App\Infrastructure\Persistence\Eloquent\Question\QuestionSignatureEloquent;
use App\Infrastructure\Persistence\Repositories\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements IQuestionRepository {

    public function list(array $filters){
        $query = QuestionEloquent::query();
        $query->select(
            'question_id',
            'question_subject',
            'question_president_id',
            'question_gov_period_id',
            'question_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'question_check_public_parliament_number',
            'person_question.created_at',
            'person_question.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_question.question_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_question.question_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_question.question_parliament_period_id');
        if (!empty($filters['question_subject'])) {
            $query->where('question_subject', 'like', '%' . $filters['question_subject'] . '%');
        }
        if (!empty($filters['question_president_id'])) {
            $query->where('question_president_id', 'like', '%' . $filters['question_president_id'] . '%');
        }
        if (!empty($filters['question_gov_period_id'])) {
            $query->where('question_gov_period_id', 'like', '%' . $filters['question_gov_period_id'] . '%');
        }
        if (!empty($filters['question_parliament_period_id'])) {
            $query->where('question_parliament_period_id', 'like', '%' . $filters['question_parliament_period_id'] . '%');
        }
        $data['count'] = $query->count();
        if (!empty($filters['page_index'])) {
            $query->skip(--$filters['page_index']*$filters['page_size']);
        }
        if (!empty($filters['page_size'])) {
            $query->take($filters['page_size']);
        }
        $data['list'] = $query->get();
        return $data;
    }
    public function findById(int $id){
        $query = QuestionEloquent::query();
        $query->select(
            'person_question.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'question_check_public_parliament_number',
            'media_worksheet.path as question_worksheet_media',
            'person_question.created_at',
            'person_question.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_question.question_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_question.question_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_question.question_parliament_period_id');
        $query->leftJoin('media as media_worksheet', 'media_worksheet.media_id', '=', 'person_question.question_answer_media_id');
         $query->where('question_id', $id);
        $result = $query->get()->toArray();
        $result[0]['question_worksheet_media'] = $this->findWorksheetMediaById($result[0]['question_worksheet_media_id']);
        $result[0]['question_answer_media_id'] = $this->findWorksheetMediaById($result[0]['question_answer_media_id']);
        $result[0]['signature_person_ids'] = $this->findSignaturesById($result[0]['question_id']);
        return $result;
    }
    public function create(array $data){
        $question_signature_person_ids = $data['question_signature_person_ids'];
        unset($data['question_signature_person_ids']);
        $result =  QuestionEloquent::create($data);
        foreach ($question_signature_person_ids as $signature_person_id) {
            QuestionSignatureEloquent::create(
                [
                    'question_id' => $result->question_id,
                    'question_person_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $question_signature_person_ids = $data['question_signature_person_ids'];
        unset($data['question_signature_person_ids']);

        $result = QuestionEloquent::where('question_id',$data['question_id'])->update(
            $data
        );


        QuestionSignatureEloquent::where('question_id',$data['question_id'])->delete();
        foreach ($question_signature_person_ids as $signature_person_id) {
            QuestionSignatureEloquent::create(
                [
                    'question_id' => $data['question_id'],
                    'question_person_id' => $signature_person_id
                ]
            );
        }
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return QuestionEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findWorksheetMediaById(int $id){
        return (new UploadRepository())->get_file($id);
    }

    public function findSignaturesById(int $id){
        return QuestionSignatureEloquent::query()->select('question_person_id as person_id')->where('question_id',$id)->get()->toArray();
    }
}
