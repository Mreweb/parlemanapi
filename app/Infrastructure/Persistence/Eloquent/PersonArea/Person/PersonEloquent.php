<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Person;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Infrastructure\Persistence\Eloquent\Common\Commission\PersonCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\Common\Election\PersonElectionEloquent;
use App\Infrastructure\Persistence\Eloquent\Common\Fraction\PersonFractionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Interpellation\InterpellationsEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Meeting\PersonMeetingEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Notice\NoticeEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\PRequests\PersonRequestEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Project\ProjectsEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Question\QuestionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Research\PersonResearchEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Rules\PersonRulesEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\RuleFortyFive\RuleFortyFiveEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\RuleTTF\RuleTTFEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Trip\TripEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\VoteConfidence\VoteConfidenceEloquent;

class PersonEloquent extends Model{
    use SoftDeletes;

    protected $table = 'person';
    protected $primaryKey = 'person_id';
    protected $guarded = [];

    public function commissions()       { return $this->hasMany(PersonCommissionEloquent::class, 'person_id'); }
    public function elections()         { return $this->hasMany(PersonElectionEloquent::class, 'person_id'); }
    public function fractions()         { return $this->hasMany(PersonFractionEloquent::class, 'person_id'); }

    public function interpellations()   { return $this->hasMany(InterpellationsEloquent::class, 'interpellation_person_id'); }
    public function meetings()          { return $this->hasMany(PersonMeetingEloquent::class, 'meeting_person_id'); }
    public function notices()           { return $this->hasMany(NoticeEloquent::class, 'notice_person_id'); }
    public function projects()          { return $this->hasMany(ProjectsEloquent::class, 'project_person_id'); }
    public function questions()         { return $this->hasMany(QuestionEloquent::class, 'question_person_id'); }
    public function requests()          { return $this->hasMany(PersonRequestEloquent::class, 'request_person_id'); }
    public function researches()        { return $this->hasMany(PersonResearchEloquent::class, 'person_research_person_id'); }
    public function rules()             { return $this->hasMany(PersonRulesEloquent::class, 'rule_person_id'); }
    public function ruleFortyFive()     { return $this->hasMany(RuleFortyFiveEloquent::class, 'rule_forty_five_person_id'); }
    public function ruleTtf()           { return $this->hasMany(RuleTTFEloquent::class, 'rule_ttf_person_id'); }
    public function trips()             { return $this->hasMany(TripEloquent::class, 'trip_person_id'); }
    public function voteConfidences()   { return $this->hasMany(VoteConfidenceEloquent::class, 'vote_confidence_person_id'); }
}
