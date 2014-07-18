SimplestXML
===========

Most simple Assoziative Array &lt;=> XML Conversion in PHP (with UTF8 support)

Use
-------

Assoziative Array => Formatted UTF8 XML
```
$sx = new SimplestXML();
$xml = $sx->to_xml('root', $data);
```

Formatted UTF8 XML => Assoziative Array
```
$sx = new SimplestXML();
$data = $sx->from_xml($xml);
```

Example
-------

```
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <a>va</a>
  <b>
    <b1>vb1</b1>
    <b2>vb2</b2>
  </b>
  <c>
    <item>
      <c-I1>vc-I1</c-I1>
      <c-I2>vc-I2</c-I2>
    </item>
    <item>
      <c-II>vc-II</c-II>
    </item>
    <item>
      <c-III>vc-III</c-III>
    </item>
  </c>
</root>
```
<=>
```
array(3) {
  ["a"]=>
  string(2) "va"
  ["b"]=>
  array(2) {
    ["b1"]=>
    string(3) "vb1"
    ["b2"]=>
    string(3) "vb2"
  }
  ["c"]=>
  array(3) {
    [0]=>
    array(2) {
      ["c-I1"]=>
      string(5) "vc-I1"
      ["c-I2"]=>
      string(5) "vc-I2"
    }
    [1]=>
    array(1) {
      ["c-II"]=>
      string(5) "vc-II"
    }
    [2]=>
    array(1) {
      ["c-III"]=>
      string(6) "vc-III"
    }
  }
}
```
