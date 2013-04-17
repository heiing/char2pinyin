char2pinyin
===========

获取汉字的拼音，支持多音字

文件说明：
---------------------------------

char2pinyin.utf8 是 utf-8 字符集的 字符-拼音 索引文件

char2pinyin.utf8.multi 是多音字索引文件，是 char2pinyin.utf8 的子集，第一个拼音的索引为0，第二个为1，依此类推。
程序中不使用本文件，本文件是为了方便配置char2pinyin.utf8.multidefault提供参考

char2pinyin.utf8.multidefault 是多音字的默认拼音配置文件，必需以“字符-拼音索引文件”+“.multidefault” 来命名。
比如“字符-拼音索引文件”是“char2pinyin.gbk”，那么默认拼音配置文件必须是“char2pinyin.gbk.multidefault”。


char2pinyin.utf8.multidefault 配置示例：

在“省”字在多音字索引文件中为“省 sheng xing”，默认拼音为 sheng，是第一个拼音，
则在 char2pinyin.utf8.multidefault 配置成 “省 0”；

又比如“广 an guang”，默认拼音为“guang”，则要配置成 “广 1”

*注：char2pinyin.utf8与char2pinyin.utf8.multidefault可以直接使用Editplus等文本编辑器转为其它字符集的文件


使用示例：
--------------------------------

include 'Pinyin.php';
$py = Pinyin::create(); // 从默认的 char2pinyin.utf8 中加载 字符-拼音 索引文件
//$py = Pinyin::create('char2pinyin.gbk'); // 从 char2pinyin.gbk 中加载 字符-拼音 索引文件

$char = '广';

echo $py->get($char), "\r\n"; // 取默认拼音

echo $py->get($char, 0), "\r\n"; // 取索引为0的拼音

print_r($py->getAll($char)); // 打印所有拼音
