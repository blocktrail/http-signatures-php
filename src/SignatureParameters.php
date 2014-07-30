<?php

namespace HttpSignatures;

class SignatureParameters
{
    public function __construct($key, $algorithm, $headerList, $signature)
    {
        $this->key = $key;
        $this->algorithm = $algorithm;
        $this->headerList = $headerList;
        $this->signature = $signature;
    }

    public function __toString()
    {
        return implode(',', $this->parameterComponents());
    }

    private function parameterComponents()
    {
        return array(
            sprintf('keyId="%s"', $this->key->id),
            sprintf('algorithm="%s"', $this->algorithm->name()),
            sprintf('headers="%s"', (string)$this->headerList),
            sprintf('signature="%s"', $this->signatureBase64()),
        );
    }

    private function signatureBase64()
    {
        return base64_encode($this->signature);
    }
}
