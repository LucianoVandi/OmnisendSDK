<?php

namespace Lvandi\OmnisendSDK\Types;

class Channel implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ChannelObject $sms;

    private ChannelObject $email;

    /**
     * @return ChannelObject
     */
    public function getSms(): ChannelObject
    {
        return $this->sms;
    }

    /**
     * @param ChannelObject $sms
     * @return Channel
     */
    public function setSms(ChannelObject $sms): Channel
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * @return ChannelObject
     */
    public function getEmail(): ChannelObject
    {
        return $this->email;
    }

    /**
     * @param ChannelObject $email
     * @return Channel
     */
    public function setEmail(ChannelObject $email): Channel
    {
        $this->email = $email;

        return $this;
    }
}
