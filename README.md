SimplestXML
===========

Most simple Associative Array &lt;=> XML Conversion in PHP (with UTF8 and CDATA support)

Use
-------

##### Associative Array => Formatted UTF8 XML
```
$sx = new SimplestXML();
$xml = $sx->to_xml('root', $data);
```
or to create a downloadable xml file
```
$sx = new SimplestXML();
$sx->makefileheader('xmlfilename');
echo $sx->to_xml('root', $data);
```

##### Formatted UTF8 XML => Associative Array
```
$sx = new SimplestXML();
$data = $sx->from_xml($xml);
```
or
```
$sx = new SimplestXML();
$data = $sx->from_xmlfile($xmlfile);
```

Example
-------

```
array(3) {
  ["a"]=>
  string(2) "va"
  ["b"]=>
  array(2) {
    ["b1"]=>
    string(12) "<vb1>x</vb1>"
    ["b2"]=>
    string(12) "<vb2>y</vb2>"
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
<=>
```
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <a>va</a>
  <b>
    <b1><![CDATA[<vb1>x</vb1>]]></b1>
    <b2><![CDATA[<vb2>y</vb2>]]></b2>
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
