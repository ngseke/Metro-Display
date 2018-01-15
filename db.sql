DROP DATABASE IF EXISTS MRT;
CREATE DATABASE MRT default character set utf8mb4 collate utf8mb4_general_ci;
SET NAMES utf8mb4;
USE MRT;

-- 路線 ;
CREATE TABLE LINE(
  Color VARCHAR(7) NOT NULL PRIMARY KEY,
  Name VARCHAR(20),
  Name_EN VARCHAR(20),
  ColorCode VARCHAR(7),
  TextColorCode VARCHAR(7) DEFAULT '#ffffff'
);

-- 插入路線 ;
INSERT INTO LINE(Color, Name, Name_EN, ColorCode)
VALUES('BR', '文湖', 'Wenhu', '#a1662c'),
      ('R', '淡水信義', 'Tamsui-Xinyi', '#d12a2f'),
      ('G', '松山新店', 'Songshan-Xindian', '#007549'),
      ('O', '中和新蘆', 'Zhonghe-Xinlu', '#ffa400'),
      ('BL', '板南', 'Bannan', '#005cb9'),
      ('RBranch', '新北投支', 'Xinbeitou Branch', '#fd92a3'),
      ('GBranch', '小碧潭支', 'Xiaobitan Branch', '#cfdb00');

-- 針對O線設定文字顏色為黑 ;
UPDATE LINE SET TextColorCode='#1e1e1e' WHERE Color = 'O';


-- 車站 ;
CREATE TABLE STATION(
  Color VARCHAR(7) NOT NULL,
  Num int(2) NOT NULL,
  Name VARCHAR(20) NOT NULL,
  Name_EN VARCHAR(50) NOT NULL,
  Name_JP VARCHAR(20) DEFAULT '',
  Name_KR VARCHAR(20) DEFAULT '',
  Name_TG VARCHAR(20) DEFAULT '',
  Terminal BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (Color, Num)
);

-- 插入 BR;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('BR', '01', '動物園', 'Taipei Zoo', TRUE),
      ('BR', '24', '南港展覽館', 'Taipei Nangang <br>Exhibition Center', TRUE);
INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('BR', '02', '木柵', 'Muzha'),
      ('BR', '03', '萬芳社區', 'Wanfang <br>Community'),
      ('BR', '04', '萬芳醫院', 'Wanfang <br>Hospital'),
      ('BR', '05', '辛亥', 'Xinhai'),
      ('BR', '06', '麟光', 'Linguang'),
      ('BR', '07', '六張犁', 'Liuzhangli'),
      ('BR', '08', '科技大樓', 'Technology <br>Building'),
      ('BR', '09', '大安', 'Daan'),
      ('BR', '10', '忠孝復興', 'Zhongxiao <br>Fuxing'),
      ('BR', '11', '南京復興', 'Nanjing <br>Fuxing'),
      ('BR', '12', '中山國中', 'Zhongshan Junior <br>High School'),
      ('BR', '13', '松山機場', 'Songshan Airport'),
      ('BR', '14', '大直', 'Dazhi'),
      ('BR', '15', '劍南路', 'Jiannan Rd.'),
      ('BR', '16', '西湖', 'Xihu'),
      ('BR', '17', '港墘', 'Gangqian'),
      ('BR', '18', '文德', 'Wende'),
      ('BR', '19', '內湖', 'Neihu'),
      ('BR', '20', '大湖公園', 'Dahu Park'),
      ('BR', '21', '葫洲', 'Huzhou'),
      ('BR', '22', '東湖', 'Donghu'),
      ('BR', '23', '南港軟體園區', 'Nangang <br>Software Park');


-- 插入 R;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('R', '02', '象山', 'Xiangshan', TRUE),
      ('R', '28', '淡水', 'Tamsui', TRUE);
INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('R', '03', '台北101/世貿', 'Taipei 101/ <br>World Trade Center'),
      ('R', '04', '信義安和', 'Xinyi Anhe'),
      ('R', '05', '大安', 'Daan'),
      ('R', '06', '大安森林公園', 'Daan Park'),
      ('R', '07', '東門', 'Dongmen'),
      ('R', '08', '中正紀念堂', 'Chiang Kai-Shek <br>Memorial Hall'),
      ('R', '09', '台大醫院', 'NTU Hospital'),
      ('R', '10', '台北車站', 'Taipei Main <br>Station'),
      ('R', '11', '中山', 'Zhongshan'),
      ('R', '12', '雙連', 'Shuanglian'),
      ('R', '13', '民權西路', 'Minquan W. Rd.'),
      ('R', '14', '圓山', 'Yuanshan'),
      ('R', '15', '劍潭', 'Jiantan'),
      ('R', '16', '士林', 'Shilin'),
      ('R', '17', '芝山', 'Zhishan'),
      ('R', '18', '明德', 'Mingde'),
      ('R', '19', '石牌', 'Shipai'),
      ('R', '20', '唭哩岸', 'Qilian'),
      ('R', '21', '奇岩', 'Qiyan'),
      ('R', '22', '北投', 'Beitou'),
      ('R', '23', '復興崗', 'Fuxinggang'),
      ('R', '24', '忠義', 'Zhongyi'),
      ('R', '25', '關渡', 'Guandu'),
      ('R', '26', '竹圍', 'Zhuwei'),
      ('R', '27', '紅樹林', 'Hongshulin');

-- 插入 G;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('G', '01', '新店', 'Xindian', TRUE),
      ('G', '19', '松山', 'Songshan', TRUE);
INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('G', '02', '新店區公所', 'Xindian District <br>Office'),
      ('G', '03', '七張', 'Qizhang'),
      ('G', '04', '大坪林', 'Dapinglin'),
      ('G', '05', '景美', 'Jingmei'),
      ('G', '06', '萬隆', 'Wanlong'),
      ('G', '07', '公館', 'Gongguan'),
      ('G', '08', '台電大樓', 'Taipower Building'),
      ('G', '09', '古亭', 'Guting'),
      ('G', '10', '中正紀念堂', 'Chiang Kai-Shek <br>Memorial Hall'),
      ('G', '11', '小南門', 'Xiaonanmen'),
      ('G', '12', '西門', 'Ximen'),
      ('G', '13', '北門', 'Beimen'),
      ('G', '14', '中山', 'Zhongshan'),
      ('G', '15', '松江南京', 'Songjiang <br>Nanjing'),
      ('G', '16', '南京復興', 'Nanjing Fuxing'),
      ('G', '17', '台北小巨蛋', 'Taipei Arena'),
      ('G', '18', '南京三民', 'Nanjing Sanmin');

-- 插入 O;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('O', '01', '南勢角', 'Nanshijiao', TRUE),
      ('O', '21', '迴龍', 'Huilong', TRUE),
      ('O', '54', '蘆洲', 'Luzhou', TRUE);

INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('O', '02', '景安', 'Jingan'),
      ('O', '03', '永安市場', 'Yongan Market'),
      ('O', '04', '頂溪', 'Dingxi'),
      ('O', '05', '古亭', 'Guting'),
      ('O', '06', '東門', 'Dongmen'),
      ('O', '07', '忠孝新生', 'Zhongxiao <br>Xinsheng'),
      ('O', '08', '松江南京', 'Songjiang <br>Nanjing'),
      ('O', '09', '行天宮', 'Xingtian Temple'),
      ('O', '10', '中山國小', 'Zhongshan <br>Elementary School'),
      ('O', '11', '民權西路', 'Minquan W. Rd.'),
      ('O', '12', '大橋頭', 'Daqiaotou'),

      ('O', '13', '台北橋', 'Taipei Bridge'),
      ('O', '14', '菜寮', 'Cailiao'),
      ('O', '15', '三重', 'Sanchong'),
      ('O', '16', '先嗇宮', 'Xianse Temple'),
      ('O', '17', '頭前庄', 'Touqianzhuang'),
      ('O', '18', '新莊', 'Xinzhuang'),
      ('O', '19', '輔大', 'Fu Jen University'),
      ('O', '20', '丹鳳', 'Danfeng'),

      ('O', '50', '三重國小', 'Sanchong <br>Elementary School'),
      ('O', '51', '三和國中', 'Sanhe Junior <br>High School'),
      ('O', '52', '徐匯中學', 'Saint Ignatius <br>High School'),
      ('O', '53', '三民高中', 'Sanmin Senior <br>High School');


-- 插入 BL;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('BL', '01', '頂埔', 'Dingpu', TRUE),
      ('BL', '23', '南港展覽館', 'Taipei Nangang <br>Exhibition Center', TRUE);
INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('BL', '02', '永寧', 'Yongning'),
      ('BL', '03', '土城', 'Tucheng'),
      ('BL', '04', '海山', 'Haishan'),
      ('BL', '05', '亞東醫院', 'Far Eastern <br>Hospital'),
      ('BL', '06', '府中', 'Fuzhong'),
      ('BL', '07', '板橋', 'Banqiao'),
      ('BL', '08', '新埔', 'Xinpu'),
      ('BL', '09', '江子翠', 'Jiangzicui'),
      ('BL', '10', '龍山寺', 'Longshan Temple'),
      ('BL', '11', '西門', 'Ximen'),
      ('BL', '12', '台北車站', 'Taipei Main <br>Station'),
      ('BL', '13', '善導寺', 'Shandao Temple'),
      ('BL', '14', '忠孝新生', 'Zhongxiao <br>Xinsheng'),
      ('BL', '15', '忠孝復興', 'Zhongxiao <br>Fuxing'),
      ('BL', '16', '忠孝敦化', 'Zhongxiao <br>Dunhua'),
      ('BL', '17', '國父紀念館', 'Sun Yat-Sen <br>Memorial Hall'),
      ('BL', '18', '市政府', 'Taipei City Hall'),
      ('BL', '19', '永春', 'Yongchun'),
      ('BL', '20', '後山埤', 'Houshanpi'),
      ('BL', '21', '昆陽', 'Kunyang'),
      ('BL', '22', '南港', 'Nangang');

-- 轉乘 ;
CREATE TABLE TRANSFER(
  Color VARCHAR(7) NOT NULL,
  Num int(2) NOT NULL,
  TransferColor VARCHAR(7) NOT NULL,
  TransferNum int(2) NOT NULL,
  TransferInsideStation BOOLEAN DEFAULT TRUE,

  PRIMARY KEY(Color,Num,TransferColor,TransferNum)
);

-- 插入轉乘站 ;
INSERT INTO TRANSFER(Color, Num, TransferColor, TransferNum)
VALUES('BR', '09', 'R', '05'),
      ('BR', '10', 'BL', '15'),
      ('BR', '11', 'G', '16'),
      ('BR', '24', 'BL', '23'),

      ('R', '05', 'BR', '09'),
      ('R', '07', 'O', '06'),
      ('R', '08', 'G', '10'),
      ('R', '10', 'BL', '12'),
      ('R', '11', 'G', '14'),
      ('R', '13', 'O', '11'),

      ('G', '09', 'O', '05'),
      ('G', '10', 'R', '08'),
      ('G', '12', 'BL', '11'),
      ('G', '14', 'R', '11'),
      ('G', '15', 'O', '08'),
      ('G', '16', 'BR', '11'),

      ('O', '05', 'G', '09'),
      ('O', '06', 'R', '07'),
      ('O', '07', 'BL', '14'),
      ('O', '08', 'G', '15'),
      ('O', '11', 'R', '13'),

      ('BL', '11', 'G', '12'),
      ('BL', '12', 'R', '10'),
      ('BL', '14', 'O', '07'),
      ('BL', '15', 'BR', '10'),
      ('BL', '23', 'BR', '24');


DROP VIEW IF EXISTS STATION_VIEW;
CREATE VIEW STATION_VIEW AS
SELECT S.Color, S.Num, S.Name, S.Name_EN , L.ColorCode, L.TextColorCode
FROM STATION AS S
JOIN LINE L ON S.Color = L.Color

;

-- SubName VARCHAR(20),
-- SubName_EN VARCHAR(20),
-- 副站名, 其他國語言站名, 轉乘, 行政區 以其他表
