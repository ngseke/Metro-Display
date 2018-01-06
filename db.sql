DROP DATABASE IF EXISTS MRT;
CREATE DATABASE MRT default character set utf8mb4 collate utf8mb4_general_ci;
SET NAMES utf8mb4;
USE MRT;

-- 路線 ;
CREATE TABLE LINE(
  Color VARCHAR(7) NOT NULL PRIMARY KEY,
  Name VARCHAR(20),
  Name_EN VARCHAR(20),
  ColorCode VARCHAR(7)
);

INSERT INTO LINE(Color, Name, Name_EN, ColorCode)
VALUES('BR', '文湖', 'Wenhu', '##a1662c'),
      ('R', '淡水信義', 'Tamsui-Xinyi', '#d12a2f'),
      ('G', '松山新店', 'Songshan-Xindian', '#007549'),
      ('O', '中和新蘆', 'Zhonghe-Xinlu', '#ffa400'),
      ('BL', '板南', 'Bannan', '#005cb9'),
      ('RBranch', '新北投支', 'Xinbeitou Branch', '#fd92a3'),
      ('GBranch', '小碧潭支', 'Xiaobitan Branch', '#cfdb00');

-- 車站 ;
CREATE TABLE STATION(
  Color VARCHAR(7) NOT NULL,
  Num int(2) NOT NULL,
  Name VARCHAR(20) NOT NULL,
  Name_EN VARCHAR(50) NOT NULL,
  Terminal BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (Color, Num)
);

INSERT INTO STATION(Color, Num, Name, Name_EN, Terminal)
VALUES('R', '02', '象山', 'Xiangshan', TRUE);

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
      ('R', '14', '圓山', 'Yuanshan');


DROP VIEW IF EXISTS STATION_VIEW;
CREATE VIEW STATION_VIEW AS
SELECT S.Name
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
