<?php


namespace Hekr\Response;


use GuzzleHttp\Psr7\Response;

class DeviceSnapshotResponse
{
    private $rmsVoltage;
    private $rmsCurrent;
    private $rmsActivePower;
    private $rmsReactivePower;
    private $rmsTotalReactivePower;
    private $rmsPowerFactor;
    private $importActiveEnergy;
    private $totalActivePower;
    private $totalEnergy;
    private $frequency;
    private $timestamp;
    private $devStatus;
    private $lastOperationTime;

    /**
     * DeviceSnapshotResponse constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $data = json_decode($response->getBody(), true);

        $snapshot = $data[0]['snapshot'];

        $this->setRmsVoltage(($snapshot['U1']['currentValue'] / 10));
        $this->setRmsCurrent(($snapshot['I1']['currentValue'] / 1000));
        $this->setRmsActivePower(($snapshot['active_Power1']['currentValue'] / 10000));
        $this->setRmsReactivePower(($snapshot['reactive_Power1']['currentValue'] / 10000));
        $this->setRmsTotalReactivePower(($snapshot['total_Reactive_Power']['currentValue'] / 10000));
        $this->setRmsPowerFactor(($snapshot['total_Constant']['currentValue'] / 1000));
        $this->setImportActiveEnergy(($snapshot['import_Active_Energy']['currentValue'] / 100));
        $this->setTotalActivePower(($snapshot['total_Active_Power']['currentValue'] / 10000));
        $this->setTotalEnergy(($snapshot['total_Energy']['currentValue'] / 100));
        $this->setFrequency(($snapshot['rate']['currentValue'] / 100));
        $this->setTimestamp($snapshot['U1']['reportTimestamp']);
        $this->setDevStatus($data[0]['devStatus']);
        $this->setLastOperationTime($data[0]['lastOprationTime']);
    }

    /**
     * @return mixed
     */
    public function getRmsVoltage()
    {
        return $this->rmsVoltage;
    }

    /**
     * @param mixed $rmsVoltage
     */
    public function setRmsVoltage($rmsVoltage): void
    {
        $this->rmsVoltage = $rmsVoltage;
    }

    /**
     * @return mixed
     */
    public function getRmsCurrent()
    {
        return $this->rmsCurrent;
    }

    /**
     * @param mixed $rmsCurrent
     */
    public function setRmsCurrent($rmsCurrent): void
    {
        $this->rmsCurrent = $rmsCurrent;
    }

    /**
     * @return mixed
     */
    public function getRmsActivePower()
    {
        return $this->rmsActivePower;
    }

    /**
     * @param mixed $rmsActivePower
     */
    public function setRmsActivePower($rmsActivePower): void
    {
        $this->rmsActivePower = $rmsActivePower;
    }

    /**
     * @return mixed
     */
    public function getRmsReactivePower()
    {
        return $this->rmsReactivePower;
    }

    /**
     * @param mixed $rmsReactivePower
     */
    public function setRmsReactivePower($rmsReactivePower): void
    {
        $this->rmsReactivePower = $rmsReactivePower;
    }

    /**
     * @return mixed
     */
    public function getRmsTotalReactivePower()
    {
        return $this->rmsTotalReactivePower;
    }

    /**
     * @param mixed $rmsTotalReactivePower
     */
    public function setRmsTotalReactivePower($rmsTotalReactivePower): void
    {
        $this->rmsTotalReactivePower = $rmsTotalReactivePower;
    }

    /**
     * @return mixed
     */
    public function getRmsPowerFactor()
    {
        return $this->rmsPowerFactor;
    }

    /**
     * @param mixed $rmsPowerFactor
     */
    public function setRmsPowerFactor($rmsPowerFactor): void
    {
        $this->rmsPowerFactor = $rmsPowerFactor;
    }

    /**
     * @return mixed
     */
    public function getImportActiveEnergy()
    {
        return $this->importActiveEnergy;
    }

    /**
     * @param mixed $importActiveEnergy
     */
    public function setImportActiveEnergy($importActiveEnergy): void
    {
        $this->importActiveEnergy = $importActiveEnergy;
    }

    /**
     * @return mixed
     */
    public function getTotalActivePower()
    {
        return $this->totalActivePower;
    }

    /**
     * @param mixed $totalActivePower
     */
    public function setTotalActivePower($totalActivePower): void
    {
        $this->totalActivePower = $totalActivePower;
    }

    /**
     * @return mixed
     */
    public function getTotalEnergy()
    {
        return $this->totalEnergy;
    }

    /**
     * @param mixed $totalEnergy
     */
    public function setTotalEnergy($totalEnergy): void
    {
        $this->totalEnergy = $totalEnergy;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency): void
    {
        $this->frequency = $frequency;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getDevStatus()
    {
        return $this->devStatus;
    }

    /**
     * @param mixed $devStatus
     */
    public function setDevStatus($devStatus): void
    {
        $this->devStatus = $devStatus;
    }

    /**
     * @return mixed
     */
    public function getLastOperationTime()
    {
        return $this->lastOperationTime;
    }

    /**
     * @param mixed $lastOperationTime
     */
    public function setLastOperationTime($lastOperationTime): void
    {
        $this->lastOperationTime = $lastOperationTime;
    }



    public function toArray()
    {
        return [
            'rmsVoltage' => $this->getRmsVoltage(),
            'rmsCurrent' => $this->getRmsCurrent(),
            'rmsActivePower' => $this->getRmsActivePower(),
            'rmsReactivePower' => $this->getRmsReactivePower(),
            'rmsTotalReactivePower' => $this->getRmsTotalReactivePower(),
            'rmsPowerFactor' => $this->getRmsPowerFactor(),
            'importActiveEnergy' => $this->getImportActiveEnergy(),
            'totalActivePower' => $this->getTotalActivePower(),
            'totalEnergy' => $this->getTotalEnergy(),
            'frequency' => $this->getFrequency(),
            'timestamp' => $this->getTimestamp(),
            'devStatus' => $this->getDevStatus(),
            'lastOperationTime' => $this->getLastOperationTime(),
        ];
    }
}