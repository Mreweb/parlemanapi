<?php

namespace App\Infrastructure\Persistence\Repositories\Interpellation;
use App\Domain\Interfaces\IInterpellationsRepository;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationOpposingEloquent;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationOptEloquent;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationReturnOptEloquent;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationsEloquent;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationsSignatoriesEloquent;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationsSupportersEloquent;
use Illuminate\Support\Facades\DB;

class InterpellationRepository implements IInterpellationsRepository {

    public function list(array $filters){
        $query = InterpellationsEloquent::query();
        $query->select(
            'interpellation_id',
            'interpellation_axis',
            'interpellation_president_id',
            'interpellation_gov_period_id',
            'interpellation_parliament_period_id',
            'period_title',
            'president_name',
            'gov_period_name',
            'interpellation_public_parliament_session_number',
            'person_interpellations.created_at',
            'person_interpellations.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_interpellations.interpellation_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_interpellations.interpellation_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_interpellations.interpellation_parliament_period_id');
        if (!empty($filters['interpellation_axis'])) {
            $query->where('interpellation_axis', 'like', '%' . $filters['interpellation_axis'] . '%');
        }
        if (!empty($filters['interpellation_president_id'])) {
            $query->where('interpellation_president_id',  $filters['interpellation_president_id'] );
        }
        if (!empty($filters['interpellation_gov_period_id'])) {
            $query->where('interpellation_gov_period_id', 'like', '%' . $filters['interpellation_gov_period_id'] . '%');
        }
        if (!empty($filters['interpellation_parliament_period_id'])) {
            $query->where('interpellation_parliament_period_id', 'like', '%' . $filters['interpellation_parliament_period_id'] . '%');
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
        $query = InterpellationsEloquent::query();
        $query->select(
            'person_interpellations.*',
            'period_title',
            'president_name',
            'gov_period_name');
        $query->leftJoin('president', 'president.president_id', '=', 'person_interpellations.interpellation_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_interpellations.interpellation_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_interpellations.interpellation_parliament_period_id');
        $query->leftJoin('media as media_worksheet', 'media_worksheet.media_id', '=', 'person_interpellations.interpellation_worksheet_media_id');
        $query->leftJoin('media as media_worksheet_correspondence', 'media_worksheet_correspondence.media_id', '=', 'person_interpellations.interpellation_correspondence_worksheet_media_id');
         $query->where('interpellation_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        $interpellations_opposing_person_ids = $data['interpellations_opposing_person_ids'];
        $interpellation_supporters_person_ids  = $data['interpellation_supporters_person_ids'];
        $interpellation_opt_person_ids = $data['interpellation_opt_person_ids'];
        $interpellation_return_opt_person_ids = $data['interpellation_return_opt_person_ids'];
        $interpellation_signatures_person_ids = $data['interpellation_signatures_person_ids'];
        unset($data['interpellations_opposing_person_ids']);
        unset($data['interpellation_supporters_person_ids']);
        unset($data['interpellation_opt_person_ids']);
        unset($data['interpellation_return_opt_person_ids']);
        unset($data['interpellation_signatures_person_ids']);
        $result =  InterpellationsEloquent::create($data);

        foreach ($interpellations_opposing_person_ids as $signature_person_id) {
            InterpellationOpposingEloquent::create(
                [
                    'interpellation_id' => $result->interpellation_id,
                    'interpellations_opposing_person_id' => $signature_person_id
                ]
            );
        }
        foreach ($interpellation_supporters_person_ids as $signature_person_id) {
            InterpellationsSupportersEloquent::create(
                [
                    'interpellation_id' => $result->interpellation_id,
                    'interpellation_supporter_person_id' => $signature_person_id
                ]
            );
        }
        foreach ($interpellation_opt_person_ids as $signature_person_id) {
            InterpellationOptEloquent::create(
                [
                    'interpellation_id' => $result->interpellation_id,
                    'interpellation_opt_person_id' => $signature_person_id
                ]
            );
        }
        foreach ($interpellation_return_opt_person_ids as $signature_person_id) {
            InterpellationReturnOptEloquent::create(
                [
                    'interpellation_id' => $result->interpellation_id,
                    'interpellation_return_opt_person_id' => $signature_person_id
                ]
            );
        }
        foreach ($interpellation_signatures_person_ids as $signature_person_id) {
            InterpellationsSignatoriesEloquent::create(
                [
                    'interpellation_id' => $result->interpellation_id,
                    'interpellation_signature_person_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $interpellations_opposing_person_ids = $data['interpellations_opposing_person_ids'];
        $interpellation_supporters_person_ids  = $data['interpellation_supporters_person_ids'];
        $interpellation_opt_person_ids = $data['interpellation_opt_person_ids'];
        $interpellation_return_opt_person_ids = $data['interpellation_return_opt_person_ids'];
        $interpellation_signatures_person_ids = $data['interpellation_signatures_person_ids'];
        unset($data['interpellations_opposing_person_ids']);
        unset($data['interpellation_supporters_person_ids']);
        unset($data['interpellation_opt_person_ids']);
        unset($data['interpellation_return_opt_person_ids']);
        unset($data['interpellation_signatures_person_ids']);


        $result = InterpellationsEloquent::where('interpellation_id',$data['interpellation_id'])->update(
            $data
        );


        InterpellationOpposingEloquent::where('interpellation_id',$data['interpellation_id'])->delete();
        foreach ($interpellations_opposing_person_ids as $signature_person_id) {
            InterpellationOpposingEloquent::create(
                [
                    'interpellation_id' => $data['interpellation_id'],
                    'interpellations_opposing_person_id' => $signature_person_id
                ]
            );
        }


        InterpellationsSupportersEloquent::where('interpellation_id',$data['interpellation_id'])->delete();
        foreach ($interpellation_supporters_person_ids as $signature_person_id) {
            InterpellationsSupportersEloquent::create(
                [
                    'interpellation_id' => $data['interpellation_id'],
                    'interpellation_supporter_person_id' => $signature_person_id
                ]
            );
        }

        InterpellationOptEloquent::where('interpellation_id',$data['interpellation_id'])->delete();
        foreach ($interpellation_opt_person_ids as $signature_person_id) {
            InterpellationOptEloquent::create(
                [
                    'interpellation_id' => $data['interpellation_id'],
                    'interpellation_opt_person_id' => $signature_person_id
                ]
            );
        }


        InterpellationReturnOptEloquent::where('interpellation_id',$data['interpellation_id'])->delete();
        foreach ($interpellation_return_opt_person_ids as $signature_person_id) {
            InterpellationReturnOptEloquent::create(
                [
                    'interpellation_id' => $data['interpellation_id'],
                    'interpellation_return_opt_person_id' => $signature_person_id
                ]
            );
        }

        InterpellationsSignatoriesEloquent::where('interpellation_id',$data['interpellation_id'])->delete();
        foreach ($interpellation_signatures_person_ids as $signature_person_id) {
            InterpellationsSignatoriesEloquent::create(
                [
                    'interpellation_id' => $data['interpellation_id'],
                    'interpellation_signature_person_id' => $signature_person_id
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
}
