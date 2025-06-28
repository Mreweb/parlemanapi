<?php

namespace App\Infrastructure\Persistence\Repositories\Person;
use App\Domain\Interfaces\IPersonRepository;
use App\Infrastructure\Persistence\Eloquent\Commission\PersonCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\Election\PersonElectionEloquent;
use App\Infrastructure\Persistence\Eloquent\Fraction\PersonFractionEloquent;
use App\Infrastructure\Persistence\Eloquent\Interpellation\InterpellationsEloquent;
use App\Infrastructure\Persistence\Eloquent\Meeting\PersonMeetingEloquent;
use App\Infrastructure\Persistence\Eloquent\Notice\NoticeEloquent;
use App\Infrastructure\Persistence\Eloquent\Person\PersonEloquent;
use App\Infrastructure\Persistence\Eloquent\PRequests\PersonRequestEloquent;
use App\Infrastructure\Persistence\Eloquent\Project\ProjectsEloquent;
use App\Infrastructure\Persistence\Eloquent\Question\QuestionEloquent;
use App\Infrastructure\Persistence\Eloquent\Research\PersonResearchEloquent;
use App\Infrastructure\Persistence\Eloquent\RuleFortyFive\RuleFortyFiveEloquent;
use App\Infrastructure\Persistence\Eloquent\Rules\PersonRulesEloquent;
use App\Infrastructure\Persistence\Eloquent\RuleTTF\RuleTTFEloquent;
use App\Infrastructure\Persistence\Eloquent\Trip\TripEloquent;
use App\Infrastructure\Persistence\Eloquent\VoteConfidence\VoteConfidenceEloquent;

class PersonRepository implements IPersonRepository {

    public function list(array $filters){
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name',
            'person_national_code','person_phone','person_email',
            'person_gender','person_province_id','username','person_image',
            'created_at','updated_at'
        );
        if (!empty($filters['person_national_code'])) {
            $query->where('person_national_code', $filters['person_national_code']);
        }
        if (!empty($filters['person_phone'])) {
            $query->where('person_phone', $filters['person_phone']);
        }
        if (!empty($filters['person_province_id'])) {
            $query->where('person_province_id', $filters['person_province_id']);
        }
        if (!empty($filters['person_last_name'])) {
            $query->where('person_last_name', 'like', '%' . $filters['person_last_name'] . '%');
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
        $query = PersonEloquent::query();
        $query->select('person_id'
            ,'person_name',
            'person_image',
            'person_last_name','person_role','person_national_code','person_phone','person_email','person_gender','person_province_id','username');
        $query->where('person_id', $id);
        $data =  $query->get()->toArray()[0];
        return $data;
    }
    public function findByField($field, $value){
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name','person_national_code','person_phone','person_email','person_gender','person_province_id','username');
        $query->where($field, $value);
        return $query->get()->toArray();
    }
    public function create(array $data){
        $person = $this->findByField('person_phone', $data['person_phone']);
        if($person){
            return [];
        } else{
            $data['password'] = md5($data['password']);
            return PersonEloquent::create($data)['person_id'];
        }
    }
    public function update(array $data){

        if(isset($data['password']) &&  $data['password'] != '') {
            $data['password'] = md5($data['password']);
            $result = PersonEloquent::where('person_id', $data['person_id'])->update(
                [
                    'person_name' => $data['person_name'],
                    'person_last_name' => $data['person_last_name'],
                    'person_national_code' => $data['person_national_code'],
                    'person_phone' => $data['person_phone'],
                    'person_gender' => $data['person_gender'],
                    'person_image' => $data['person_image'],
                    'person_province_id' => $data['person_province_id'],
                    'username' => $data['username'],
                    'password' => $data['password']
                ]
            );
        } else{
            $result = PersonEloquent::where('person_id', $data['person_id'])->update(
                [
                    'person_name' => $data['person_name'],
                    'person_last_name' => $data['person_last_name'],
                    'person_national_code' => $data['person_national_code'],
                    'person_phone' => $data['person_phone'],
                    'person_gender' => $data['person_gender'],
                    'person_image' => $data['person_image'],
                    'person_province_id' => $data['person_province_id'],
                    'username' => $data['username']
                ]
            );
        }
        return $result;
    }
    public function delete(int $id){
        $province = PersonEloquent::findOrFail($id)->delete();
        return $province;
    }
    public function update_fraction(array $data){
        PersonFractionEloquent::where('person_id', $data['person_id'])->delete();
        return PersonFractionEloquent::create($data)['person_id'];
    }
    public function update_election(array $data){
        PersonElectionEloquent::where('person_id', $data['person_id'])->delete();
        return PersonElectionEloquent::create($data)['person_id'];
    }
    public function update_commission(array $data){
        PersonCommissionEloquent::where('person_id', $data['person_id'])->delete();
        return PersonCommissionEloquent::create($data)['person_id'];
    }

    private function get_person_commission($id){
        return PersonCommissionEloquent::query()
            ->join('commission', 'person_commission.commission_id', '=', 'commission.commission_id')
            ->where('person_commission.person_id', $id)
            ->get()->toArray();
    }
    private function get_person_election($id){
        return PersonElectionEloquent::query()
            ->join('election_location', 'person_election.election_id', '=', 'election_location.election_location_id')
            ->where('person_election.person_id', $id)
            ->get()->toArray();
    }
    private function get_person_fraction($id){
        return PersonFractionEloquent::query()
            ->join('fraction', 'fraction.fraction_id', '=', 'person_fraction.fraction_id')
            ->where('person_fraction.person_id', $id)
            ->get()->toArray();
    }
    private function get_person_interpellations($id){
        return InterpellationsEloquent::query()->where('interpellation_person_id', $id)->get()->toArray();
    }
    private function get_person_meeting($id){
        return PersonMeetingEloquent::query()->where('meeting_person_id', $id)->get()->toArray();
    }
    private function get_person_notice($id){
        return NoticeEloquent::query()->where('notice_person_id', $id)->get()->toArray();
    }
    private function get_person_projects($id){
        return ProjectsEloquent::query()->where('project_person_id', $id)->get()->toArray();
    }
    private function get_person_question($id){
        return QuestionEloquent::query()->where('question_person_id', $id)->get()->toArray();
    }
    private function get_person_requests($id){
        return PersonRequestEloquent::query()->where('request_person_id', $id)->get()->toArray();
    }
    private function get_person_research($id){
        return PersonResearchEloquent::query()->where('person_research_person_id', $id)->get()->toArray();
    }
    private function get_person_rules($id){
        return PersonRulesEloquent::query()->where('rule_person_id', $id)->get()->toArray();
    }
    private function get_person_rule_forty_five($id){
        return RuleFortyFiveEloquent::query()->where('rule_forty_five_person_id', $id)->get()->toArray();
    }
    private function get_person_rule_ttf($id){
        return RuleTTFEloquent::query()->where('rule_ttf_person_id', $id)->get()->toArray();
    }
    private function get_person_trip($id){
        return TripEloquent::query()->where('trip_person_id', $id)->get()->toArray();
    }
    private function get_person_vote_confidence($id){
        return VoteConfidenceEloquent::query()->where('vote_confidence_person_id', $id)->get()->toArray();
    }
    public function get_all_info(int $id){
        $result['person_info'] = $this->findById($id);
        $result['person_commission'] = $this->get_person_commission($id);
        $result['person_election'] = $this->get_person_election($id);
        $result['person_fraction'] = $this->get_person_fraction($id);
        $result['person_interpellations'] = $this->get_person_interpellations($id);
        $result['person_meeting'] = $this->get_person_meeting($id);
        $result['person_notice'] = $this->get_person_notice($id);
        $result['person_projects'] = $this->get_person_projects($id);
        $result['person_question'] = $this->get_person_question($id);
        $result['person_requests'] = $this->get_person_requests($id);
        $result['person_research'] = $this->get_person_research($id);
        $result['person_rules'] = $this->get_person_rules($id);
        $result['person_rule_forty_five'] = $this->get_person_rule_forty_five($id);
        $result['person_rule_ttf'] = $this->get_person_rule_ttf($id);
        $result['person_trip'] = $this->get_person_trip($id);
        $result['person_vote_confidence'] = $this->get_person_vote_confidence($id);
        return $result;
    }
}
