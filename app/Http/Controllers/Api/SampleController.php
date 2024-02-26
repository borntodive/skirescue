<?php

namespace App\Http\Controllers\Api;

use App\Events\SampleCreated;
use App\Http\Controllers\Controller;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sensor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SampleController extends Controller
{
    public function store(Request $request)
    {

        ini_set('max_execution_time', 120);
        /* $validator = Validator::make($this->toSnakeCase($request->all()), [
            'data' => 'required|array',

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        } */
        $respose = [];
        $samples = $request['data'];
        $status = 200;
        $insertedSensors = [];
        $datas = [];
        $userId = null;
        foreach ($samples as $idx => $sample) {
            /*  $validator = Validator::make($sample, [
                'date' => 'required|integer|between:0,2147483648',
                'value' => 'required|array',
                'value.*' => 'numeric',
                'userId' => 'required|integer|exists:users,id',
                'measureType' => 'required|string|exists:sensors,name',
            ]);
            if ($validator->fails()) {
                $status = 422;
                continue;
            } */
            $errors = false;
            $sensor = Sensor::firstWhere('name', $sample['measureType']);

            if (!$sensor) {
                $errors = true;
                $status = 422;
            } else {
                $sample['sensor_id'] = $sensor->id;
                $sample['measureType'];
            }
            $operator = User::find($sample['userId']);
            $opsCentral = $operator->skiarea->opscentral;
            if (!$errors) {
                if (is_array($sample['value'])) {
                    $delta = 1000 / count($sample['value']);
                    $time = Carbon::createFromTimestamp($sample['date'])->timezone('UTC');

                    foreach ($sample['value'] as $val) {
                        $data = [
                            'metadata' => ['sensorId' => $sample['sensor_id'], 'userId' => $operator->_id, 'opsCentralId' => $opsCentral->_id, 'skiAreaId' => $operator->skiarea->_id, 'measureType' => $sample['measureType']],
                            'timestamp' => $time->toIso8601String(),
                            'value' => $val,
                        ];


                        $datas[] = $data;
                        $newSample = new Sample($data);
                        $newSample->save();

                        // event(new SampleCreated($newSample));
                        if ($sensor->name == 'Ecg') {
                            $d['x'] = $time->getPreciseTimestamp() / 1000;
                            $d['y'] = round((float) $val * 1000, 0);

                            $userId = $sample['userId'];
                        }
                        $time = $time->addMicroseconds(floor($delta * 1000));
                    }
                } else {
                    $time = Carbon::createFromTimestamp($sample['date'])->timezone('UTC');
                    $data =
                        [
                            'metadata' => ['sensorId' => $sample['sensor_id'], 'userId' => $operator->_id, 'opsCentralId' => $opsCentral->_id, 'skiAreaId' => $operator->skiarea->_id, 'measureType' => $sample['measureType']],
                            'timestamp' => $time->toIso8601String(),
                            'value' => $sample['date'],
                        ];

                    $newSample = new Sample($data);
                    $newSample->save();
                    // event(new SampleCreated($newSample));
                }
            }
        }

        //Sample::insert($datas);
        if ($status == 200) {
            $respose['message'] = 'All samples created successfully';
        } else {
            $respose['message'] = 'One or more samples were invalid';
        }
        return response()->json($respose, $status);
    }


    private function toSnakeCase($array)
    {
        $snakeCase = [];
        foreach ($array as $name => $value) {
            $snakeCase[Str::snake($name)] = $value;
        }

        return $snakeCase;
    }
}
