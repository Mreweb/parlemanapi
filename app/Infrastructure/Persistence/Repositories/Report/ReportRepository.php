<?php

namespace App\Infrastructure\Persistence\Repositories\Report;

use App\Domain\Interfaces\IReportRepository;
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
use Illuminate\Support\Facades\DB;

class ReportRepository implements IReportRepository
{

    private function get_interpellations($filter){
        $query = DB::query();
        $query->select('person_id', 'person_name', 'person_last_name',
            'person_national_code', 'person_phone', 'person_email',
            'person_gender', 'person_province_id', 'username', 'person_image',
            'created_at', 'updated_at'
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
    }

    private function get_person_meeting($id)
    {
        return PersonMeetingEloquent::query()->where('meeting_person_id', $id)->get()->toArray();
    }

    private function get_person_notice($id)
    {
        return NoticeEloquent::query()->where('notice_person_id', $id)->get()->toArray();
    }

    private function get_person_projects($id)
    {
        return ProjectsEloquent::query()->where('project_person_id', $id)->get()->toArray();
    }

    private function get_person_question($id)
    {
        return QuestionEloquent::query()->where('question_person_id', $id)->get()->toArray();
    }

    private function get_person_requests($id)
    {
        return PersonRequestEloquent::query()->where('request_person_id', $id)->get()->toArray();
    }

    private function get_person_research($id)
    {
        return PersonResearchEloquent::query()->where('person_research_person_id', $id)->get()->toArray();
    }

    private function get_person_rules($id)
    {
        return PersonRulesEloquent::query()->where('rule_person_id', $id)->get()->toArray();
    }

    private function get_person_rule_forty_five($id)
    {
        return RuleFortyFiveEloquent::query()->where('rule_forty_five_person_id', $id)->get()->toArray();
    }

    private function get_person_rule_ttf($id)
    {
        return RuleTTFEloquent::query()->where('rule_ttf_person_id', $id)->get()->toArray();
    }

    private function get_person_trip($id)
    {
        return TripEloquent::query()->where('trip_person_id', $id)->get()->toArray();
    }

    private function get_person_vote_confidence($id)
    {
        return VoteConfidenceEloquent::query()->where('vote_confidence_person_id', $id)->get()->toArray();
    }

    public function data_count($filter)
    {
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
