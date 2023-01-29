<?php

namespace app\src\services;

use app\src\interfaces\RegisterServiceInterface;
use app\src\models\Client;
use app\src\models\Worker;
use app\src\requests\register\RegisterClientRequest;
use app\src\requests\register\RegisterWorkerRequest;
use yii\base\Model;

class RegisterSerivce implements RegisterServiceInterface
{
    /**
     * @param \app\src\requests\register\RegisterClientRequest $request
     * @return array
     */
    public function registerClient(Model $request): array
    {
        $client = (new Client())->setName($request->name)
        ->setMiddleName($request->middle_name)->setLastName($request->last_name)
        ->setPassportNumber($request->passport_number)->setPassportSeries($request->passport_series);
        $client->save();
        return ['message' => 'Клиент успешно создан!', 'client' => $client];
    }

    /**
     * @param RegisterWorkerRequest $request
     * @return array
     */
    public function registerWorker(Model $request): array
    {
        $worker = (new Worker())->setName($request->name)
            ->setMiddleName($request->middle_name)->setLastName($request->last_name)
            ->setPasswordHash($request->password)->setLogin($request->login)->setPositionId($request->position_id);
        $worker->save();
        return ['message' => 'Работник успешно создан!', 'worker' => $worker];
    }
}
