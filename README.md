nBuryloAuthBundle
=================
## Installation

Installation depends on how your project is setup:

### Step 1: Installation

Add the following lines to your ``deps`` file

```
[nBuryloAuthBundle]
    git=http://github.com/lukaszburylo/AuthBundle.git
    target=/bundles/nBurylo/AuthBundle
    
```

Next, update your vendors by running:

``` bash
$ ./bin/vendors install
```

### Step 2: Configure the autoloader

Add the following entries to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    
    'nBurylo'   => __DIR__.'/../vendor/bundles',
));
```

### Step 3: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new nBurylo\AuthBundle\nBuryloAuthBundle(),
    );
}
```
