<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Biz.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Ressource file for biz idn validation
 *
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
return array(
    1  => '/^[\x{002d}0-9a-zäåæéöøü]{1,63}$/iu',
    2  => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
    3  => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu',
    4  => '/^[\x{002d}0-9a-záæéíðóöúýþ]{1,63}$/iu',
    5  => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu',
    6  => '/^[\x{002d}0-9a-ząčėęįšūųž]{1,63}$/iu',
    7  => '/^[\x{002d}0-9a-zāčēģīķļņōŗšūž]{1,63}$/iu',
    8  => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøüčđńŋšŧž]{1,63}$/iu',
    9  => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
    10 => '/^[\x{002d}0-9a-záàâãçéêíóôõú]{1,63}$/iu',
    11 => '/^[\x{002d}0-9a-z\x{3005}-\x{3007}\x{3041}-\x{3093}\x{309D}\x{309E}\x{30A1}-\x{30F6}\x{30FC}' .
'\x{30FD}\x{30FE}\x{4E00}\x{4E01}\x{4E03}\x{4E07}\x{4E08}\x{4E09}\x{4E0A}' .
'\x{4E0B}\x{4E0D}\x{4E0E}\x{4E10}\x{4E11}\x{4E14}\x{4E15}\x{4E16}\x{4E17}' .
'\x{4E18}\x{4E19}\x{4E1E}\x{4E21}\x{4E26}\x{4E2A}\x{4E2D}\x{4E31}\x{4E32}' .
'\x{4E36}\x{4E38}\x{4E39}\x{4E3B}\x{4E3C}\x{4E3F}\x{4E42}\x{4E43}\x{4E45}' .
'\x{4E4B}\x{4E4D}\x{4E4E}\x{4E4F}\x{4E55}\x{4E56}\x{4E57}\x{4E58}\x{4E59}' .
'\x{4E5D}\x{4E5E}\x{4E5F}\x{4E62}\x{4E71}\x{4E73}\x{4E7E}\x{4E80}\x{4E82}' .
'\x{4E85}\x{4E86}\x{4E88}\x{4E89}\x{4E8A}\x{4E8B}\x{4E8C}\x{4E8E}\x{4E91}' .
'\x{4E92}\x{4E94}\x{4E95}\x{4E98}\x{4E99}\x{4E9B}\x{4E9C}\x{4E9E}\x{4E9F}' .
'\x{4EA0}\x{4EA1}\x{4EA2}\x{4EA4}\x{4EA5}\x{4EA6}\x{4EA8}\x{4EAB}\x{4EAC}' .
'\x{4EAD}\x{4EAE}\x{4EB0}\x{4EB3}\x{4EB6}\x{4EBA}\x{4EC0}\x{4EC1}\x{4EC2}' .
'\x{4EC4}\x{4EC6}\x{4EC7}\x{4ECA}\x{4ECB}\x{4ECD}\x{4ECE}\x{4ECF}\x{4ED4}' .
'\x{4ED5}\x{4ED6}\x{4ED7}\x{4ED8}\x{4ED9}\x{4EDD}\x{4EDE}\x{4EDF}\x{4EE3}' .
'\x{4EE4}\x{4EE5}\x{4EED}\x{4EEE}\x{4EF0}\x{4EF2}\x{4EF6}\x{4EF7}\x{4EFB}' .
'\x{4F01}\x{4F09}\x{4F0A}\x{4F0D}\x{4F0E}\x{4F0F}\x{4F10}\x{4F11}\x{4F1A}' .
'\x{4F1C}\x{4F1D}\x{4F2F}\x{4F30}\x{4F34}\x{4F36}\x{4F38}\x{4F3A}\x{4F3C}' .
'\x{4F3D}\x{4F43}\x{4F46}\x{4F47}\x{4F4D}\x{4F4E}\x{4F4F}\x{4F50}\x{4F51}' .
'\x{4F53}\x{4F55}\x{4F57}\x{4F59}\x{4F5A}\x{4F5B}\x{4F5C}\x{4F5D}\x{4F5E}' .
'\x{4F69}\x{4F6F}\x{4F70}\x{4F73}\x{4F75}\x{4F76}\x{4F7B}\x{4F7C}\x{4F7F}' .
'\x{4F83}\x{4F86}\x{4F88}\x{4F8B}\x{4F8D}\x{4F8F}\x{4F91}\x{4F96}\x{4F98}' .
'\x{4F9B}\x{4F9D}\x{4FA0}\x{4FA1}\x{4FAB}\x{4FAD}\x{4FAE}\x{4FAF}\x{4FB5}' .
'\x{4FB6}\x{4FBF}\x{4FC2}\x{4FC3}\x{4FC4}\x{4FCA}\x{4FCE}\x{4FD0}\x{4FD1}' .
'\x{4FD4}\x{4FD7}\x{4FD8}\x{4FDA}\x{4FDB}\x{4FDD}\x{4FDF}\x{4FE1}\x{4FE3}' .
'\x{4FE4}\x{4FE5}\x{4FEE}\x{4FEF}\x{4FF3}\x{4FF5}\x{4FF6}\x{4FF8}\x{4FFA}' .
'\x{4FFE}\x{5005}\x{5006}\x{5009}\x{500B}\x{500D}\x{500F}\x{5011}\x{5012}' .
'\x{5014}\x{5016}\x{5019}\x{501A}\x{501F}\x{5021}\x{5023}\x{5024}\x{5025}' .
'\x{5026}\x{5028}\x{5029}\x{502A}\x{502B}\x{502C}\x{502D}\x{5036}\x{5039}' .
'\x{5043}\x{5047}\x{5048}\x{5049}\x{504F}\x{5050}\x{5055}\x{5056}\x{505A}' .
'\x{505C}\x{5065}\x{506C}\x{5072}\x{5074}\x{5075}\x{5076}\x{5078}\x{507D}' .
'\x{5080}\x{5085}\x{508D}\x{5091}\x{5098}\x{5099}\x{509A}\x{50AC}\x{50AD}' .
'\x{50B2}\x{50B3}\x{50B4}\x{50B5}\x{50B7}\x{50BE}\x{50C2}\x{50C5}\x{50C9}' .
'\x{50CA}\x{50CD}\x{50CF}\x{50D1}\x{50D5}\x{50D6}\x{50DA}\x{50DE}\x{50E3}' .
'\x{50E5}\x{50E7}\x{50ED}\x{50EE}\x{50F5}\x{50F9}\x{50FB}\x{5100}\x{5101}' .
'\x{5102}\x{5104}\x{5109}\x{5112}\x{5114}\x{5115}\x{5116}\x{5118}\x{511A}' .
'\x{511F}\x{5121}\x{512A}\x{5132}\x{5137}\x{513A}\x{513B}\x{513C}\x{513F}' .
'\x{5140}\x{5141}\x{5143}\x{5144}\x{5145}\x{5146}\x{5147}\x{5148}\x{5149}' .
'\x{514B}\x{514C}\x{514D}\x{514E}\x{5150}\x{5152}\x{5154}\x{515A}\x{515C}' .
'\x{5162}\x{5165}\x{5168}\x{5169}\x{516A}\x{516B}\x{516C}\x{516D}\x{516E}' .
'\x{5171}\x{5175}\x{5176}\x{5177}\x{5178}\x{517C}\x{5180}\x{5182}\x{5185}' .
'\x{5186}\x{5189}\x{518A}\x{518C}\x{518D}\x{518F}\x{5190}\x{5191}\x{5192}' .
'\x{5193}\x{5195}\x{5196}\x{5197}\x{5199}\x{51A0}\x{51A2}\x{51A4}\x{51A5}' .
'\x{51A6}\x{51A8}\x{51A9}\x{51AA}\x{51AB}\x{51AC}\x{51B0}\x{51B1}\x{51B2}' .
'\x{51B3}\x{51B4}\x{51B5}\x{51B6}\x{51B7}\x{51BD}\x{51C4}\x{51C5}\x{51C6}' .
'\x{51C9}\x{51CB}\x{51CC}\x{51CD}\x{51D6}\x{51DB}\x{51DC}\x{51DD}\x{51E0}' .
'\x{51E1}\x{51E6}\x{51E7}\x{51E9}\x{51EA}\x{51ED}\x{51F0}\x{51F1}\x{51F5}' .
'\x{51F6}\x{51F8}\x{51F9}\x{51FA}\x{51FD}\x{51FE}\x{5200}\x{5203}\x{5204}' .
'\x{5206}\x{5207}\x{5208}\x{520A}\x{520B}\x{520E}\x{5211}\x{5214}\x{5217}' .
'\x{521D}\x{5224}\x{5225}\x{5227}\x{5229}\x{522A}\x{522E}\x{5230}\x{5233}' .
'\x{5236}\x{5237}\x{5238}\x{5239}\x{523A}\x{523B}\x{5243}\x{5244}\x{5247}' .
'\x{524A}\x{524B}\x{524C}\x{524D}\x{524F}\x{5254}\x{5256}\x{525B}\x{525E}' .
'\x{5263}\x{5264}\x{5265}\x{5269}\x{526A}\x{526F}\x{5270}\x{5271}\x{5272}' .
'\x{5273}\x{5274}\x{5275}\x{527D}\x{527F}\x{5283}\x{5287}\x{5288}\x{5289}' .
'\x{528D}\x{5291}\x{5292}\x{5294}\x{529B}\x{529F}\x{52A0}\x{52A3}\x{52A9}' .
'\x{52AA}\x{52AB}\x{52AC}\x{52AD}\x{52B1}\x{52B4}\x{52B5}\x{52B9}\x{52BC}' .
'\x{52BE}\x{52C1}\x{52C3}\x{52C5}\x{52C7}\x{52C9}\x{52CD}\x{52D2}\x{52D5}' .
'\x{52D7}\x{52D8}\x{52D9}\x{52DD}\x{52DE}\x{52DF}\x{52E0}\x{52E2}\x{52E3}' .
'\x{52E4}\x{52E6}\x{52E7}\x{52F2}\x{52F3}\x{52F5}\x{52F8}\x{52F9}\x{52FA}' .
'\x{52FE}\x{52FF}\x{5301}\x{5302}\x{5305}\x{5306}\x{5308}\x{530D}\x{530F}' .
'\x{5310}\x{5315}\x{5316}\x{5317}\x{5319}\x{531A}\x{531D}\x{5320}\x{5321}' .
'\x{5323}\x{532A}\x{532F}\x{5331}\x{5333}\x{5338}\x{5339}\x{533A}\x{533B}' .
'\x{533F}\x{5340}\x{5341}\x{5343}\x{5345}\x{5346}\x{5347}\x{5348}\x{5349}' .
'\x{534A}\x{534D}\x{5351}\x{5352}\x{5353}\x{5354}\x{5357}\x{5358}\x{535A}' .
'\x{535C}\x{535E}\x{5360}\x{5366}\x{5369}\x{536E}\x{536F}\x{5370}\x{5371}' .
'\x{5373}\x{5374}\x{5375}\x{5377}\x{5378}\x{537B}\x{537F}\x{5382}\x{5384}' .
'\x{5396}\x{5398}\x{539A}\x{539F}\x{53A0}\x{53A5}\x{53A6}\x{53A8}\x{53A9}' .
'\x{53AD}\x{53AE}\x{53B0}\x{53B3}\x{53B6}\x{53BB}\x{53C2}\x{53C3}\x{53C8}' .
'\x{53C9}\x{53CA}\x{53CB}\x{53CC}\x{53CD}\x{53CE}\x{53D4}\x{53D6}\x{53D7}' .
'\x{53D9}\x{53DB}\x{53DF}\x{53E1}\x{53E2}\x{53E3}\x{53E4}\x{53E5}\x{53E8}' .
'\x{53E9}\x{53EA}\x{53EB}\x{53EC}\x{53ED}\x{53EE}\x{53EF}\x{53F0}\x{53F1}' .
'\x{53F2}\x{53F3}\x{53F6}\x{53F7}\x{53F8}\x{53FA}\x{5401}\x{5403}\x{5404}' .
'\x{5408}\x{5409}\x{540A}\x{540B}\x{540C}\x{540D}\x{540E}\x{540F}\x{5410}' .
'\x{5411}\x{541B}\x{541D}\x{541F}\x{5420}\x{5426}\x{5429}\x{542B}\x{542C}' .
'\x{542D}\x{542E}\x{5436}\x{5438}\x{5439}\x{543B}\x{543C}\x{543D}\x{543E}' .
'\x{5440}\x{5442}\x{5446}\x{5448}\x{5449}\x{544A}\x{544E}\x{5451}\x{545F}' .
'\x{5468}\x{546A}\x{5470}\x{5471}\x{5473}\x{5475}\x{5476}\x{5477}\x{547B}' .
'\x{547C}\x{547D}\x{5480}\x{5484}\x{5486}\x{548B}\x{548C}\x{548E}\x{548F}' .
'\x{5490}\x{5492}\x{54A2}\x{54A4}\x{54A5}\x{54A8}\x{54AB}\x{54AC}\x{54AF}' .
'\x{54B2}\x{54B3}\x{54B8}\x{54BC}\x{54BD}\x{54BE}\x{54C0}\x{54C1}\x{54C2}' .
'\x{54C4}\x{54C7}\x{54C8}\x{54C9}\x{54D8}\x{54E1}\x{54E2}\x{54E5}\x{54E6}' .
'\x{54E8}\x{54E9}\x{54ED}\x{54EE}\x{54F2}\x{54FA}\x{54FD}\x{5504}\x{5506}' .
'\x{5507}\x{550F}\x{5510}\x{5514}\x{5516}\x{552E}\x{552F}\x{5531}\x{5533}' .
'\x{5538}\x{5539}\x{553E}\x{5540}\x{5544}\x{5545}\x{5546}\x{554C}\x{554F}' .
'\x{5553}\x{5556}\x{5557}\x{555C}\x{555D}\x{5563}\x{557B}\x{557C}\x{557E}' .
'\x{5580}\x{5583}\x{5584}\x{5587}\x{5589}\x{558A}\x{558B}\x{5598}\x{5599}' .
'\x{559A}\x{559C}\x{559D}\x{559E}\x{559F}\x{55A7}\x{55A8}\x{55A9}\x{55AA}' .
'\x{55AB}\x{55AC}\x{55AE}\x{55B0}\x{55B6}\x{55C4}\x{55C5}\x{55C7}\x{55D4}' .
'\x{55DA}\x{55DC}\x{55DF}\x{55E3}\x{55E4}\x{55F7}\x{55F9}\x{55FD}\x{55FE}' .
'\x{5606}\x{5609}\x{5614}\x{5616}\x{5617}\x{5618}\x{561B}\x{5629}\x{562F}' .
'\x{5631}\x{5632}\x{5634}\x{5636}\x{5638}\x{5642}\x{564C}\x{564E}\x{5650}' .
'\x{565B}\x{5664}\x{5668}\x{566A}\x{566B}\x{566C}\x{5674}\x{5678}\x{567A}' .
'\x{5680}\x{5686}\x{5687}\x{568A}\x{568F}\x{5694}\x{56A0}\x{56A2}\x{56A5}' .
'\x{56AE}\x{56B4}\x{56B6}\x{56BC}\x{56C0}\x{56C1}\x{56C2}\x{56C3}\x{56C8}' .
'\x{56CE}\x{56D1}\x{56D3}\x{56D7}\x{56D8}\x{56DA}\x{56DB}\x{56DE}\x{56E0}' .
'\x{56E3}\x{56EE}\x{56F0}\x{56F2}\x{56F3}\x{56F9}\x{56FA}\x{56FD}\x{56FF}' .
'\x{5700}\x{5703}\x{5704}\x{5708}\x{5709}\x{570B}\x{570D}\x{570F}\x{5712}' .
'\x{5713}\x{5716}\x{5718}\x{571C}\x{571F}\x{5726}\x{5727}\x{5728}\x{572D}' .
'\x{5730}\x{5737}\x{5738}\x{573B}\x{5740}\x{5742}\x{5747}\x{574A}\x{574E}' .
'\x{574F}\x{5750}\x{5751}\x{5761}\x{5764}\x{5766}\x{5769}\x{576A}\x{577F}' .
'\x{5782}\x{5788}\x{5789}\x{578B}\x{5793}\x{57A0}\x{57A2}\x{57A3}\x{57A4}' .
'\x{57AA}\x{57B0}\x{57B3}\x{57C0}\x{57C3}\x{57C6}\x{57CB}\x{57CE}\x{57D2}' .
'\x{57D3}\x{57D4}\x{57D6}\x{57DC}\x{57DF}\x{57E0}\x{57E3}\x{57F4}\x{57F7}' .
'\x{57F9}\x{57FA}\x{57FC}\x{5800}\x{5802}\x{5805}\x{5806}\x{580A}\x{580B}' .
'\x{5815}\x{5819}\x{581D}\x{5821}\x{5824}\x{582A}\x{582F}\x{5830}\x{5831}' .
'\x{5834}\x{5835}\x{583A}\x{583D}\x{5840}\x{5841}\x{584A}\x{584B}\x{5851}' .
'\x{5852}\x{5854}\x{5857}\x{5858}\x{5859}\x{585A}\x{585E}\x{5862}\x{5869}' .
'\x{586B}\x{5870}\x{5872}\x{5875}\x{5879}\x{587E}\x{5883}\x{5885}\x{5893}' .
'\x{5897}\x{589C}\x{589F}\x{58A8}\x{58AB}\x{58AE}\x{58B3}\x{58B8}\x{58B9}' .
'\x{58BA}\x{58BB}\x{58BE}\x{58C1}\x{58C5}\x{58C7}\x{58CA}\x{58CC}\x{58D1}' .
'\x{58D3}\x{58D5}\x{58D7}\x{58D8}\x{58D9}\x{58DC}\x{58DE}\x{58DF}\x{58E4}' .
'\x{58E5}\x{58EB}\x{58EC}\x{58EE}\x{58EF}\x{58F0}\x{58F1}\x{58F2}\x{58F7}' .
'\x{58F9}\x{58FA}\x{58FB}\x{58FC}\x{58FD}\x{5902}\x{5909}\x{590A}\x{590F}' .
'\x{5910}\x{5915}\x{5916}\x{5918}\x{5919}\x{591A}\x{591B}\x{591C}\x{5922}' .
'\x{5925}\x{5927}\x{5929}\x{592A}\x{592B}\x{592C}\x{592D}\x{592E}\x{5931}' .
'\x{5932}\x{5937}\x{5938}\x{593E}\x{5944}\x{5947}\x{5948}\x{5949}\x{594E}' .
'\x{594F}\x{5950}\x{5951}\x{5954}\x{5955}\x{5957}\x{5958}\x{595A}\x{5960}' .
'\x{5962}\x{5965}\x{5967}\x{5968}\x{5969}\x{596A}\x{596C}\x{596E}\x{5973}' .
'\x{5974}\x{5978}\x{597D}\x{5981}\x{5982}\x{5983}\x{5984}\x{598A}\x{598D}' .
'\x{5993}\x{5996}\x{5999}\x{599B}\x{599D}\x{59A3}\x{59A5}\x{59A8}\x{59AC}' .
'\x{59B2}\x{59B9}\x{59BB}\x{59BE}\x{59C6}\x{59C9}\x{59CB}\x{59D0}\x{59D1}' .
'\x{59D3}\x{59D4}\x{59D9}\x{59DA}\x{59DC}\x{59E5}\x{59E6}\x{59E8}\x{59EA}' .
'\x{59EB}\x{59F6}\x{59FB}\x{59FF}\x{5A01}\x{5A03}\x{5A09}\x{5A11}\x{5A18}' .
'\x{5A1A}\x{5A1C}\x{5A1F}\x{5A20}\x{5A25}\x{5A29}\x{5A2F}\x{5A35}\x{5A36}' .
'\x{5A3C}\x{5A40}\x{5A41}\x{5A46}\x{5A49}\x{5A5A}\x{5A62}\x{5A66}\x{5A6A}' .
'\x{5A6C}\x{5A7F}\x{5A92}\x{5A9A}\x{5A9B}\x{5ABC}\x{5ABD}\x{5ABE}\x{5AC1}' .
'\x{5AC2}\x{5AC9}\x{5ACB}\x{5ACC}\x{5AD0}\x{5AD6}\x{5AD7}\x{5AE1}\x{5AE3}' .
'\x{5AE6}\x{5AE9}\x{5AFA}\x{5AFB}\x{5B09}\x{5B0B}\x{5B0C}\x{5B16}\x{5B22}' .
'\x{5B2A}\x{5B2C}\x{5B30}\x{5B32}\x{5B36}\x{5B3E}\x{5B40}\x{5B43}\x{5B45}' .
'\x{5B50}\x{5B51}\x{5B54}\x{5B55}\x{5B57}\x{5B58}\x{5B5A}\x{5B5B}\x{5B5C}' .
'\x{5B5D}\x{5B5F}\x{5B63}\x{5B64}\x{5B65}\x{5B66}\x{5B69}\x{5B6B}\x{5B70}' .
'\x{5B71}\x{5B73}\x{5B75}\x{5B78}\x{5B7A}\x{5B80}\x{5B83}\x{5B85}\x{5B87}' .
'\x{5B88}\x{5B89}\x{5B8B}\x{5B8C}\x{5B8D}\x{5B8F}\x{5B95}\x{5B97}\x{5B98}' .
'\x{5B99}\x{5B9A}\x{5B9B}\x{5B9C}\x{5B9D}\x{5B9F}\x{5BA2}\x{5BA3}\x{5BA4}' .
'\x{5BA5}\x{5BA6}\x{5BAE}\x{5BB0}\x{5BB3}\x{5BB4}\x{5BB5}\x{5BB6}\x{5BB8}' .
'\x{5BB9}\x{5BBF}\x{5BC2}\x{5BC3}\x{5BC4}\x{5BC5}\x{5BC6}\x{5BC7}\x{5BC9}' .
'\x{5BCC}\x{5BD0}\x{5BD2}\x{5BD3}\x{5BD4}\x{5BDB}\x{5BDD}\x{5BDE}\x{5BDF}' .
'\x{5BE1}\x{5BE2}\x{5BE4}\x{5BE5}\x{5BE6}\x{5BE7}\x{5BE8}\x{5BE9}\x{5BEB}' .
'\x{5BEE}\x{5BF0}\x{5BF3}\x{5BF5}\x{5BF6}\x{5BF8}\x{5BFA}\x{5BFE}\x{5BFF}' .
'\x{5C01}\x{5C02}\x{5C04}\x{5C05}\x{5C06}\x{5C07}\x{5C08}\x{5C09}\x{5C0A}' .
'\x{5C0B}\x{5C0D}\x{5C0E}\x{5C0F}\x{5C11}\x{5C13}\x{5C16}\x{5C1A}\x{5C20}' .
'\x{5C22}\x{5C24}\x{5C28}\x{5C2D}\x{5C31}\x{5C38}\x{5C39}\x{5C3A}\x{5C3B}' .
'\x{5C3C}\x{5C3D}\x{5C3E}\x{5C3F}\x{5C40}\x{5C41}\x{5C45}\x{5C46}\x{5C48}' .
'\x{5C4A}\x{5C4B}\x{5C4D}\x{5C4E}\x{5C4F}\x{5C50}\x{5C51}\x{5C53}\x{5C55}' .
'\x{5C5E}\x{5C60}\x{5C61}\x{5C64}\x{5C65}\x{5C6C}\x{5C6E}\x{5C6F}\x{5C71}' .
'\x{5C76}\x{5C79}\x{5C8C}\x{5C90}\x{5C91}\x{5C94}\x{5CA1}\x{5CA8}\x{5CA9}' .
'\x{5CAB}\x{5CAC}\x{5CB1}\x{5CB3}\x{5CB6}\x{5CB7}\x{5CB8}\x{5CBB}\x{5CBC}' .
'\x{5CBE}\x{5CC5}\x{5CC7}\x{5CD9}\x{5CE0}\x{5CE1}\x{5CE8}\x{5CE9}\x{5CEA}' .
'\x{5CED}\x{5CEF}\x{5CF0}\x{5CF6}\x{5CFA}\x{5CFB}\x{5CFD}\x{5D07}\x{5D0B}' .
'\x{5D0E}\x{5D11}\x{5D14}\x{5D15}\x{5D16}\x{5D17}\x{5D18}\x{5D19}\x{5D1A}' .
'\x{5D1B}\x{5D1F}\x{5D22}\x{5D29}\x{5D4B}\x{5D4C}\x{5D4E}\x{5D50}\x{5D52}' .
'\x{5D5C}\x{5D69}\x{5D6C}\x{5D6F}\x{5D73}\x{5D76}\x{5D82}\x{5D84}\x{5D87}' .
'\x{5D8B}\x{5D8C}\x{5D90}\x{5D9D}\x{5DA2}\x{5DAC}\x{5DAE}\x{5DB7}\x{5DBA}' .
'\x{5DBC}\x{5DBD}\x{5DC9}\x{5DCC}\x{5DCD}\x{5DD2}\x{5DD3}\x{5DD6}\x{5DDB}' .
'\x{5DDD}\x{5DDE}\x{5DE1}\x{5DE3}\x{5DE5}\x{5DE6}\x{5DE7}\x{5DE8}\x{5DEB}' .
'\x{5DEE}\x{5DF1}\x{5DF2}\x{5DF3}\x{5DF4}\x{5DF5}\x{5DF7}\x{5DFB}\x{5DFD}' .
'\x{5DFE}\x{5E02}\x{5E03}\x{5E06}\x{5E0B}\x{5E0C}\x{5E11}\x{5E16}\x{5E19}' .
'\x{5E1A}\x{5E1B}\x{5E1D}\x{5E25}\x{5E2B}\x{5E2D}\x{5E2F}\x{5E30}\x{5E33}' .
'\x{5E36}\x{5E37}\x{5E38}\x{5E3D}\x{5E40}\x{5E43}\x{5E44}\x{5E45}\x{5E47}' .
'\x{5E4C}\x{5E4E}\x{5E54}\x{5E55}\x{5E57}\x{5E5F}\x{5E61}\x{5E62}\x{5E63}' .
'\x{5E64}\x{5E72}\x{5E73}\x{5E74}\x{5E75}\x{5E76}\x{5E78}\x{5E79}\x{5E7A}' .
'\x{5E7B}\x{5E7C}\x{5E7D}\x{5E7E}\x{5E7F}\x{5E81}\x{5E83}\x{5E84}\x{5E87}' .
'\x{5E8A}\x{5E8F}\x{5E95}\x{5E96}\x{5E97}\x{5E9A}\x{5E9C}\x{5EA0}\x{5EA6}' .
'\x{5EA7}\x{5EAB}\x{5EAD}\x{5EB5}\x{5EB6}\x{5EB7}\x{5EB8}\x{5EC1}\x{5EC2}' .
'\x{5EC3}\x{5EC8}\x{5EC9}\x{5ECA}\x{5ECF}\x{5ED0}\x{5ED3}\x{5ED6}\x{5EDA}' .
'\x{5EDB}\x{5EDD}\x{5EDF}\x{5EE0}\x{5EE1}\x{5EE2}\x{5EE3}\x{5EE8}\x{5EE9}' .
'\x{5EEC}\x{5EF0}\x{5EF1}\x{5EF3}\x{5EF4}\x{5EF6}\x{5EF7}\x{5EF8}\x{5EFA}' .
'\x{5EFB}\x{5EFC}\x{5EFE}\x{5EFF}\x{5F01}\x{5F03}\x{5F04}\x{5F09}\x{5F0A}' .
'\x{5F0B}\x{5F0C}\x{5F0D}\x{5F0F}\x{5F10}\x{5F11}\x{5F13}\x{5F14}\x{5F15}' .
'\x{5F16}\x{5F17}\x{5F18}\x{5F1B}\x{5F1F}\x{5F25}\x{5F26}\x{5F27}\x{5F29}' .
'\x{5F2D}\x{5F2F}\x{5F31}\x{5F35}\x{5F37}\x{5F38}\x{5F3C}\x{5F3E}\x{5F41}' .
'\x{5F48}\x{5F4A}\x{5F4C}\x{5F4E}\x{5F51}\x{5F53}\x{5F56}\x{5F57}\x{5F59}' .
'\x{5F5C}\x{5F5D}\x{5F61}\x{5F62}\x{5F66}\x{5F69}\x{5F6A}\x{5F6B}\x{5F6C}' .
'\x{5F6D}\x{5F70}\x{5F71}\x{5F73}\x{5F77}\x{5F79}\x{5F7C}\x{5F7F}\x{5F80}' .
'\x{5F81}\x{5F82}\x{5F83}\x{5F84}\x{5F85}\x{5F87}\x{5F88}\x{5F8A}\x{5F8B}' .
'\x{5F8C}\x{5F90}\x{5F91}\x{5F92}\x{5F93}\x{5F97}\x{5F98}\x{5F99}\x{5F9E}' .
'\x{5FA0}\x{5FA1}\x{5FA8}\x{5FA9}\x{5FAA}\x{5FAD}\x{5FAE}\x{5FB3}\x{5FB4}' .
'\x{5FB9}\x{5FBC}\x{5FBD}\x{5FC3}\x{5FC5}\x{5FCC}\x{5FCD}\x{5FD6}\x{5FD7}' .
'\x{5FD8}\x{5FD9}\x{5FDC}\x{5FDD}\x{5FE0}\x{5FE4}\x{5FEB}\x{5FF0}\x{5FF1}' .
'\x{5FF5}\x{5FF8}\x{5FFB}\x{5FFD}\x{5FFF}\x{600E}\x{600F}\x{6010}\x{6012}' .
'\x{6015}\x{6016}\x{6019}\x{601B}\x{601C}\x{601D}\x{6020}\x{6021}\x{6025}' .
'\x{6026}\x{6027}\x{6028}\x{6029}\x{602A}\x{602B}\x{602F}\x{6031}\x{603A}' .
'\x{6041}\x{6042}\x{6043}\x{6046}\x{604A}\x{604B}\x{604D}\x{6050}\x{6052}' .
'\x{6055}\x{6059}\x{605A}\x{605F}\x{6060}\x{6062}\x{6063}\x{6064}\x{6065}' .
'\x{6068}\x{6069}\x{606A}\x{606B}\x{606C}\x{606D}\x{606F}\x{6070}\x{6075}' .
'\x{6077}\x{6081}\x{6083}\x{6084}\x{6089}\x{608B}\x{608C}\x{608D}\x{6092}' .
'\x{6094}\x{6096}\x{6097}\x{609A}\x{609B}\x{609F}\x{60A0}\x{60A3}\x{60A6}' .
'\x{60A7}\x{60A9}\x{60AA}\x{60B2}\x{60B3}\x{60B4}\x{60B5}\x{60B6}\x{60B8}' .
'\x{60BC}\x{60BD}\x{60C5}\x{60C6}\x{60C7}\x{60D1}\x{60D3}\x{60D8}\x{60DA}' .
'\x{60DC}\x{60DF}\x{60E0}\x{60E1}\x{60E3}\x{60E7}\x{60E8}\x{60F0}\x{60F1}' .
'\x{60F3}\x{60F4}\x{60F6}\x{60F7}\x{60F9}\x{60FA}\x{60FB}\x{6100}\x{6101}' .
'\x{6103}\x{6106}\x{6108}\x{6109}\x{610D}\x{610E}\x{610F}\x{6115}\x{611A}' .
'\x{611B}\x{611F}\x{6121}\x{6127}\x{6128}\x{612C}\x{6134}\x{613C}\x{613D}' .
'\x{613E}\x{613F}\x{6142}\x{6144}\x{6147}\x{6148}\x{614A}\x{614B}\x{614C}' .
'\x{614D}\x{614E}\x{6153}\x{6155}\x{6158}\x{6159}\x{615A}\x{615D}\x{615F}' .
'\x{6162}\x{6163}\x{6165}\x{6167}\x{6168}\x{616B}\x{616E}\x{616F}\x{6170}' .
'\x{6171}\x{6173}\x{6174}\x{6175}\x{6176}\x{6177}\x{617E}\x{6182}\x{6187}' .
'\x{618A}\x{618E}\x{6190}\x{6191}\x{6194}\x{6196}\x{6199}\x{619A}\x{61A4}' .
'\x{61A7}\x{61A9}\x{61AB}\x{61AC}\x{61AE}\x{61B2}\x{61B6}\x{61BA}\x{61BE}' .
'\x{61C3}\x{61C6}\x{61C7}\x{61C8}\x{61C9}\x{61CA}\x{61CB}\x{61CC}\x{61CD}' .
'\x{61D0}\x{61E3}\x{61E6}\x{61F2}\x{61F4}\x{61F6}\x{61F7}\x{61F8}\x{61FA}' .
'\x{61FC}\x{61FD}\x{61FE}\x{61FF}\x{6200}\x{6208}\x{6209}\x{620A}\x{620C}' .
'\x{620D}\x{620E}\x{6210}\x{6211}\x{6212}\x{6214}\x{6216}\x{621A}\x{621B}' .
'\x{621D}\x{621E}\x{621F}\x{6221}\x{6226}\x{622A}\x{622E}\x{622F}\x{6230}' .
'\x{6232}\x{6233}\x{6234}\x{6238}\x{623B}\x{623F}\x{6240}\x{6241}\x{6247}' .
'\x{6248}\x{6249}\x{624B}\x{624D}\x{624E}\x{6253}\x{6255}\x{6258}\x{625B}' .
'\x{625E}\x{6260}\x{6263}\x{6268}\x{626E}\x{6271}\x{6276}\x{6279}\x{627C}' .
'\x{627E}\x{627F}\x{6280}\x{6282}\x{6283}\x{6284}\x{6289}\x{628A}\x{6291}' .
'\x{6292}\x{6293}\x{6294}\x{6295}\x{6296}\x{6297}\x{6298}\x{629B}\x{629C}' .
'\x{629E}\x{62AB}\x{62AC}\x{62B1}\x{62B5}\x{62B9}\x{62BB}\x{62BC}\x{62BD}' .
'\x{62C2}\x{62C5}\x{62C6}\x{62C7}\x{62C8}\x{62C9}\x{62CA}\x{62CC}\x{62CD}' .
'\x{62CF}\x{62D0}\x{62D1}\x{62D2}\x{62D3}\x{62D4}\x{62D7}\x{62D8}\x{62D9}' .
'\x{62DB}\x{62DC}\x{62DD}\x{62E0}\x{62E1}\x{62EC}\x{62ED}\x{62EE}\x{62EF}' .
'\x{62F1}\x{62F3}\x{62F5}\x{62F6}\x{62F7}\x{62FE}\x{62FF}\x{6301}\x{6302}' .
'\x{6307}\x{6308}\x{6309}\x{630C}\x{6311}\x{6319}\x{631F}\x{6327}\x{6328}' .
'\x{632B}\x{632F}\x{633A}\x{633D}\x{633E}\x{633F}\x{6349}\x{634C}\x{634D}' .
'\x{634F}\x{6350}\x{6355}\x{6357}\x{635C}\x{6367}\x{6368}\x{6369}\x{636B}' .
'\x{636E}\x{6372}\x{6376}\x{6377}\x{637A}\x{637B}\x{6380}\x{6383}\x{6388}' .
'\x{6389}\x{638C}\x{638E}\x{638F}\x{6392}\x{6396}\x{6398}\x{639B}\x{639F}' .
'\x{63A0}\x{63A1}\x{63A2}\x{63A3}\x{63A5}\x{63A7}\x{63A8}\x{63A9}\x{63AA}' .
'\x{63AB}\x{63AC}\x{63B2}\x{63B4}\x{63B5}\x{63BB}\x{63BE}\x{63C0}\x{63C3}' .
'\x{63C4}\x{63C6}\x{63C9}\x{63CF}\x{63D0}\x{63D2}\x{63D6}\x{63DA}\x{63DB}' .
'\x{63E1}\x{63E3}\x{63E9}\x{63EE}\x{63F4}\x{63F6}\x{63FA}\x{6406}\x{640D}' .
'\x{640F}\x{6413}\x{6416}\x{6417}\x{641C}\x{6426}\x{6428}\x{642C}\x{642D}' .
'\x{6434}\x{6436}\x{643A}\x{643E}\x{6442}\x{644E}\x{6458}\x{6467}\x{6469}' .
'\x{646F}\x{6476}\x{6478}\x{647A}\x{6483}\x{6488}\x{6492}\x{6493}\x{6495}' .
'\x{649A}\x{649E}\x{64A4}\x{64A5}\x{64A9}\x{64AB}\x{64AD}\x{64AE}\