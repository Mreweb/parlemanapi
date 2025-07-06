<?php

namespace App\Infrastructure\Persistence\Repositories\Report;

use App\Domain\Interfaces\IReportRepository;
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

class ReportRepository implements IReportRepository{


    private function get_person_meeting($filters){
        $query = PersonMeetingEloquent::query();
        $query->join('person', 'person.person_id', '=', 'person_meeting.meeting_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_notice($filters){
        $query = NoticeEloquent::query();
        $query->join('person', 'person.person_id', '=', 'person_notice.notice_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();

    }
    private function get_person_projects($filters){
        $query = ProjectsEloquent::query();
        $query->join('person', 'person.person_id', '=', 'person_projects.project_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_question($filters){
        $query = QuestionEloquent::query();
        $query->join('person', 'person.person_id', '=',  'person_question.question_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_requests($filters){
        $query = PersonRequestEloquent::query();
        $query->join('person', 'person.person_id', '=',  'person_requests.request_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_research($filters){
        $query = PersonResearchEloquent::query();
        $query->join('person', 'person.person_id', '=',  'person_research.person_research_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_rules($filters){
        $query = PersonRulesEloquent::query();
        $query->join('person', 'person.person_id', '=',  'person_rules.rule_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_rule_forty_five($filters){
        $query = RuleFortyFiveEloquent::query();
        $query->join('person', 'person.person_id', '=', 'person_rule_forty_five.rule_forty_five_person_id' );
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_rule_ttf($filters){
        $query = RuleTTFEloquent::query();
        $query->join('person', 'person.person_id', '=', 'person_rule_ttf.rule_ttf_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_trip($filters){
        $query = TripEloquent::query();
        $query->join('person', 'person.person_id', '=', 'person_trip.trip_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }
    private function get_person_vote_confidence($filters){
        $query = VoteConfidenceEloquent::query();
        $query->join('person', 'person.person_id', '=',  'person_vote_confidence.vote_confidence_person_id');
        $query->join('province', 'person.person_province_id', '=', 'province.province_id');
        if($filters['person_id'] != null){
            $query->where('person.person_id', $filters['person_id']);
        }
        if($filters['province_id'] != null){
            $query->where('province.province_id', $filters['province_id']);
        }
        return $query->get()->count();
    }

    public function data_count($filters){
        $result['meeting_count'] = $this->get_person_meeting($filters);
        $result['notice_count'] = $this->get_person_notice($filters);
        $result['projects_count'] = $this->get_person_projects($filters);
        $result['question_count'] = $this->get_person_question($filters);
        $result['requests_count'] = $this->get_person_requests($filters);
        $result['research_count'] = $this->get_person_research($filters);
        $result['rules_count'] = $this->get_person_rules($filters);
        $result['rule_forty_five_count'] = $this->get_person_rule_forty_five($filters);
        $result['rule_ttf_count'] = $this->get_person_rule_ttf($filters);
        $result['trip_count'] = $this->get_person_trip($filters);
        $result['vote_confidence_count'] = $this->get_person_vote_confidence($filters);
        return $result;
    }

    public function search($filters)
    {
        // TODO: Implement search() method.
    }
}
