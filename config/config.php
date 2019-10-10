<?php


return array_merge(
    (new Jnjxp\Cdnjs\ConfigProvider())(),
    include __DIR__ . '/cdnjs.php'
);
