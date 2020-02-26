<?php

exec('/usr/bin/git -C "'.__DIR__.'" pull > /dev/null 2>&1 &', $output, $return_var);

echo '<pre>'.print_r($output,1).'</pre>';