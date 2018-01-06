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
VALUES('BR', '文湖', 'Wenhu', '##a1662c'),
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
  Terminal BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (Color, Num)
);

-- 插入 R;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('R', '02', '象山', 'Xiangshan', TRUE),
      ('R', '28', '淡水', 'Tamsui', TRUE);
INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('R', '03', '台北101/世貿', 'Taipei 101/World Trade Center'),
      ('R', '04', '信義安和', 'Xinyi Anhe'),
      ('R', '05', '大安', 'Daan'),
      ('R', '06', '大安森林公園', 'Daan Park'),
      ('R', '07', '東門', 'Dongmen'),
      ('R', '08', '中正紀念堂', 'Chiang Kai-Shek Memorial Hall'),
      ('R', '09', '台大醫院', 'National Taiwan University Hospital'),
      ('R', '10', '台北車站', 'Taipei Main Station'),
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
      ('R', '21', '奇岩', 'Beitou'),
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
VALUES('G', '02', '新店區公所', 'Xindian District Office'),
      ('G', '03', '七張', 'Qizhang'),
      ('G', '04', '大坪林', 'Dapinglin'),
      ('G', '05', '景美', 'Jingmei'),
      ('G', '06', '萬隆', 'Wanlong'),
      ('G', '07', '公館', 'Gongguan'),
      ('G', '08', '台電大樓', 'Taipower Building'),
      ('G', '09', '古亭', 'Guting'),
      ('G', '10', '中正紀念堂', 'Chiang Kai-Shek Memorial Hall'),
      ('G', '11', '小南門', 'Xiaonanmen'),
      ('G', '12', '西門', 'Ximen'),
      ('G', '13', '北門', 'Beimen'),
      ('G', '14', '中山', 'Zhongshan'),
      ('G', '15', '松江南京', 'Songjiang Nanjing'),
      ('G', '16', '南京復興', 'Nanjing Fuxing'),
      ('G', '17', '台北小巨蛋', 'Taipei Arena'),
      ('G', '18', '南京三民', 'Nanjing Sanmin');

-- 插入 BL;
INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('BL', '01', '頂埔', 'Dingpu', TRUE),
      ('BL', '23', '南港展覽館', 'Taipei Nangang Exhibition Center', TRUE);
INSERT INTO STATION(Color, Num, Name, Name_EN)
VALUES('BL', '02', '永寧', 'Yongning'),
      ('BL', '03', '土城', 'Tucheng'),
      ('BL', '04', '海山', 'Haishan'),
      ('BL', '05', '亞東醫院', 'Far Eastern Hospital'),
      ('BL', '06', '府中', 'Fuzhong'),
      ('BL', '07', '板橋', 'Banqiao'),
      ('BL', '08', '新埔', 'Xinpu'),
      ('BL', '09', '江子翠', 'Jiangzicui'),
      ('BL', '10', '龍山寺', 'Longshan Temple'),
      ('BL', '11', '西門', 'Ximen'),
      ('BL', '12', '台北車站', 'Taipei Main Station'),
      ('BL', '13', '善導寺', 'Shandao Temple'),
      ('BL', '14', '忠孝新生', 'Zhongxiao Xinsheng'),
      ('BL', '15', '忠孝復興', 'Zhongxiao Fuxing'),
      ('BL', '16', '忠孝敦化', 'Zhongxiao Dunhua'),
      ('BL', '17', '國父紀念館', 'Sun Yat-Sen Memorial Hall'),
      ('BL', '18', '市政府', 'Taipei City Hall'),
      ('BL', '19', '永春', 'Yongchun'),
      ('BL', '20', '後山埤', 'Houshanpi'),
      ('BL', '21', '昆陽', 'Taipei Arena'),
      ('BL', '22', '南港', 'Nangang');



DROP VIEW IF EXISTS STATION_VIEW;
CREATE VIEW STATION_VIEW AS
SELECT S.Color, S.Num, S.Name, S.Name_EN , L.ColorCode
FROM STATION AS S
JOIN LINE L ON S.Color = L.Color
;


-- 轉乘 ;
-- CREATE TABLE TRANSFER(
--
-- );
--
-- CREATE TABLE OPERATION_MODE(
--
-- );

-- SubName VARCHAR(20),
-- SubName_EN VARCHAR(20),
-- 副站名, 其他國語言站名, 轉乘, 行政區 以其他表
