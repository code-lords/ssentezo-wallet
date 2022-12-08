<?php

namespace SsentezoWallet\Traits;

trait MobileNumber
{
    /**
     * Formats the mobile money mobile number to the correct format that is expected by the endpoint
     * @param string $mobile  The mobile number to be formatted
     * @return string The formatted mobile number
     */
    public function formatMobileLocal($mobile)
    {
        $length = strlen($mobile);
        $m = '0';
        //format 1: +256752665888
        if ($length == 13)
            return $m .= substr($mobile, 4);
        elseif ($length == 12) //format 2: 256752665888
            return $m .= substr($mobile, 3);
        elseif ($length == 10) //format 3: 0752665888
            return $mobile;
        elseif ($length == 9) //format 4: 752665888
            return $m .= $mobile;

        return $mobile;
    }
}
