BinaryFileWriter
================

helper class to write binary files

Example:

```php
include 'BinaryFileWriter.php';

$writer = new BinaryFileWriter('test.dat');

$writer->writeByte(0xff);
$writer->writeString('this is a test');
$writer->writeShort(12345);
$writer->writeInt(1234567);

$writer->close();
```
