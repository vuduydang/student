<?php

namespace App\Repositories\Students;

use App\Jobs\SendMail;
use App\Mail\Mailler;
use App\Repositories\EloquentRepository;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class StudentRepository extends EloquentRepository implements StudentRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getModel()
    {
        return Student::class;
    }

    /**
     * @param int $userId
     * @return Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getProfile(object $user)
    {
        $student = $this->_model->query()->where('user_id',$user->id)->first();
        if (!$student) {
            $this->create([
                'user_id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email,
                'birthday'=>date('Y-m-d'),
                'avatar'=>'null.png'
            ]);
        }
        return $student;
    }

    /**
     * @param $action
     * @param object $request
     */
    public function uploaderImage($action , object $request)
    {
        if ($action=='update')
        {
            File::delete('./images/avatars/'.$request->avatarDefault);
        }
        $file = $request->file('avatar');
        $folder = 'images/avatars';
        $file->move($folder, Date('Y-m-d_') . $file->getClientOriginalName());
        return Date('Y-m-d_') . $file->getClientOriginalName();
    }

    public function filter(array $value)
    {
        $students = $this->_model->query();
            if (array_key_exists('phone',$value)) {
                $regex = '';
                if (in_array('viettel', $value['phone']))
                {
                    $regex .= '(03[2-9]|09[6|7|8]|08[6])+([0-9]{7})|';
                }
                if (in_array('vinaphone', $value['phone']))
                {
                    $regex .= '(09[1|4]|08[1-5|8])+([0-9]{7})|';
                }
                if (in_array('mobifone', $value['phone']))
                {
                    $regex .= '(090|089|07[0|6-9])+([0-9]{7})|';
                }
                $students->where('phone', 'regexp', rtrim($regex, '|'));
            }

            //filter Status
            if (array_key_exists('status', $value)) {
                if ($value['status'] == 'Passed') {
                    $students->where('status','1');
                }
                if ($value['status'] == 'Studying') {
                    $students->where('status','0');
                }
                if ($value['status'] == 'Failed') {
                    $students->where('status','-1');
                }
            }

            if (array_key_exists('filter',$value)) {

                //filter Age
                $min = $value['age_min'] == null ? 0 : $value['age_min'];
                $max = $value['age_max'] == null ? 100 : $value['age_max'];
                $age_min = Carbon::now()->subYears($min)->toDateString();
                $age_max = Carbon::now()->subYears($max)->toDateString();
                $students->where('birthday','<=',$age_min)
                    ->where('birthday','>=',$age_max);

                //filter Score
                $min = $value['score_min'] == null ? 0 : $value['score_min'];
                $max = $value['score_max'] == null ? 10 : $value['score_max'];
                $students->where('avg_score','>=',$min)
                    ->where('avg_score','<=',$max);
            }
//        return $students->get();
        return $students->with('course')->paginate(20);
    }

    public function sendMail($request)
    {
        if ($request->has('action')) {
            $action = $request->get('action');
            $title = $request->get('title');
            $content = $request->get('content');
            if ($action == 'all') {
                $students = $this->_model->query()->where('status','=',0)->get(['name','email','avg_score']);
                foreach ($students as $student) {
                    $data = [
                        'name'=>$student->name,
                        'email'=>$student->email,
                        'avg_score'=>$student->avg_score,
                        'title'=>$title,
                        'content'=>$content
                    ];
                    dispatch(new SendMail($data))->delay(Carbon::now()->addSeconds(0));
                }
            }
            if ($action == 'score') {
                $students = $this->_model->query()
                    ->where('status','=',1)
                    ->where('avg_score','<',5)->get(['name','email','avg_score']);
                foreach ($students as $student) {
                    $data = [
                        'name'=>$student->name,
                        'email'=>$student->email,
                        'avg_score'=>$student->avg_score,
                        'title'=>$title,
                        'content'=>$content
                    ];
                    dispatch(new SendMail($data))->delay(Carbon::now()->addSeconds(0));
                }
            }
        } else {
            dispatch(new SendMail($request->all()))->delay(Carbon::now()->addSeconds(0));
        }
    }

}
