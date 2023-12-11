<?php

//Модуль тестирования форматтеров вывода результата работы программы

namespace Differ\Differ;

use PHPUnit\Framework\TestCase;

class FormattersTest extends TestCase
{

    /**
     * @dataProvider rightResults
     */
    public function testFormatOutput(
        string $rightResultOfStylishFormatOutput,
        string $rightResultOfPlainFormatOutput,
        string $rightResultOfJsonFormatOutput,
        string $genDiffRightResultInJson
    ) {
        $genDiffResultArr = json_decode($genDiffRightResultInJson, true);

        $stylishFormatTestResult = resultArrayToResultString($genDiffResultArr, 'stylish');
        $this->assertEquals($rightResultOfStylishFormatOutput, $stylishFormatTestResult);
        $plainFormatTestResult = resultArrayToResultString($genDiffResultArr, 'plain');
        $this->assertEquals($rightResultOfPlainFormatOutput, $plainFormatTestResult);
        $jsonFormatTestResult = resultArrayToResultString($genDiffResultArr, 'json');
        $this->assertEquals($rightResultOfJsonFormatOutput, $jsonFormatTestResult);
    }

    public static function rightResults(): array
    {
        return [
            ['{
    common: {
      + follow: false
        setting1: Value 1
      - setting2: 200
      - setting3: true
      + setting3: null
      + setting4: blah blah
      + setting5: {
            key5: value5
        }
        setting6: {
            doge: {
              - wow: 
              + wow: so much
            }
            key: value
          + ops: vops
        }
    }
    group1: {
      - baz: bas
      + baz: bars
        foo: bar
      - nest: {
            key: value
        }
      + nest: str
    }
  - group2: {
        abc: 12345
        deep: {
            id: 45
        }
    }
  + group3: {
        deep: {
            id: {
                number: 45
            }
        }
        fee: 100500
    }
}', "Property 'common.follow' was added with value: false
Property 'common.setting2' was removed
Property 'common.setting3' was updated. From true to null
Property 'common.setting4' was added with value: 'blah blah'
Property 'common.setting5' was added with value: [complex value]
Property 'common.setting6.doge.wow' was updated. From '' to 'so much'
Property 'common.setting6.ops' was added with value: 'vops'
Property 'group1.baz' was updated. From 'bas' to 'bars'
Property 'group1.nest' was updated. From [complex value] to 'str'
Property 'group2' was removed
Property 'group3' was added with value: [complex value]", '[
    {
        "nodeKey": "common",
        "child": [
            {
                "nodeKey": "follow",
                "nodeValue": false,
                "diffStatus": "added"
            },
            {
                "nodeKey": "setting1",
                "nodeValue": "Value 1",
                "diffStatus": "unchanged"
            },
            {
                "nodeKey": "setting2",
                "nodeValue": 200,
                "diffStatus": "deleted"
            },
            {
                "nodeKey": "setting3",
                "nodeValueOld": true,
                "nodeValueNew": null,
                "diffStatus": "updated"
            },
            {
                "nodeKey": "setting4",
                "nodeValue": "blah blah",
                "diffStatus": "added"
            },
            {
                "nodeKey": "setting5",
                "nodeValue": {
                    "key5": "value5"
                },
                "diffStatus": "added"
            },
            {
                "nodeKey": "setting6",
                "child": [
                    {
                        "nodeKey": "doge",
                        "child": [
                            {
                                "nodeKey": "wow",
                                "nodeValueOld": "",
                                "nodeValueNew": "so much",
                                "diffStatus": "updated"
                            }
                        ]
                    },
                    {
                        "nodeKey": "key",
                        "nodeValue": "value",
                        "diffStatus": "unchanged"
                    },
                    {
                        "nodeKey": "ops",
                        "nodeValue": "vops",
                        "diffStatus": "added"
                    }
                ]
            }
        ]
    },
    {
        "nodeKey": "group1",
        "child": [
            {
                "nodeKey": "baz",
                "nodeValueOld": "bas",
                "nodeValueNew": "bars",
                "diffStatus": "updated"
            },
            {
                "nodeKey": "foo",
                "nodeValue": "bar",
                "diffStatus": "unchanged"
            },
            {
                "nodeKey": "nest",
                "nodeValueOld": {
                    "key": "value"
                },
                "nodeValueNew": "str",
                "diffStatus": "updated"
            }
        ]
    },
    {
        "nodeKey": "group2",
        "nodeValue": {
            "abc": 12345,
            "deep": {
                "id": 45
            }
        },
        "diffStatus": "deleted"
    },
    {
        "nodeKey": "group3",
        "nodeValue": {
            "deep": {
                "id": {
                    "number": 45
                }
            },
            "fee": 100500
        },
        "diffStatus": "added"
    }
]', '[
    {
        "nodeKey": "common",
        "child": [
            {
                "nodeKey": "follow",
                "nodeValue": false,
                "diffStatus": "added"
            },
            {
                "nodeKey": "setting1",
                "nodeValue": "Value 1",
                "diffStatus": "unchanged"
            },
            {
                "nodeKey": "setting2",
                "nodeValue": 200,
                "diffStatus": "deleted"
            },
            {
                "nodeKey": "setting3",
                "nodeValueOld": true,
                "nodeValueNew": null,
                "diffStatus": "updated"
            },
            {
                "nodeKey": "setting4",
                "nodeValue": "blah blah",
                "diffStatus": "added"
            },
            {
                "nodeKey": "setting5",
                "nodeValue": {
                    "key5": "value5"
                },
                "diffStatus": "added"
            },
            {
                "nodeKey": "setting6",
                "child": [
                    {
                        "nodeKey": "doge",
                        "child": [
                            {
                                "nodeKey": "wow",
                                "nodeValueOld": "",
                                "nodeValueNew": "so much",
                                "diffStatus": "updated"
                            }
                        ]
                    },
                    {
                        "nodeKey": "key",
                        "nodeValue": "value",
                        "diffStatus": "unchanged"
                    },
                    {
                        "nodeKey": "ops",
                        "nodeValue": "vops",
                        "diffStatus": "added"
                    }
                ]
            }
        ]
    },
    {
        "nodeKey": "group1",
        "child": [
            {
                "nodeKey": "baz",
                "nodeValueOld": "bas",
                "nodeValueNew": "bars",
                "diffStatus": "updated"
            },
            {
                "nodeKey": "foo",
                "nodeValue": "bar",
                "diffStatus": "unchanged"
            },
            {
                "nodeKey": "nest",
                "nodeValueOld": {
                    "key": "value"
                },
                "nodeValueNew": "str",
                "diffStatus": "updated"
            }
        ]
    },
    {
        "nodeKey": "group2",
        "nodeValue": {
            "abc": 12345,
            "deep": {
                "id": 45
            }
        },
        "diffStatus": "deleted"
    },
    {
        "nodeKey": "group3",
        "nodeValue": {
            "deep": {
                "id": {
                    "number": 45
                }
            },
            "fee": 100500
        },
        "diffStatus": "added"
    }
]
']];
    }
}
