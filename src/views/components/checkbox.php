<?php

echo e(Aire::checkbox('checkbox', 'Confirm that you agree'));

echo e(Aire::checkbox('opt_out', 'Opt-out of annoying emails')
	->defaultChecked());
