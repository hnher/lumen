<?php

return [
    //NSQ 服务自动发现地址
    'lookupd' => explode(',', env('NSQ_LOOKUPD', 'http://127.0.0.1:4161')),
    'topic' => []
];
