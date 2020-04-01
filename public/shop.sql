-- 数据库
create database shop default character set utf8;


use shop;


-- 1.地点
create table place(
    id  int unsigned  key auto_increment,
    province varchar(20) not null,
    placename varchar(100) not null unique
);
insert into place(province,placename)values('北京市','北京市朝阳区三元桥中电发展大厦Z座1层');
insert into place(province,placename)values('长沙市','湖南省长沙市四元桥中电发展大厦R座2层');
insert into place(province,placename)values('天津市','天津市朝阳区五元桥中电发展大厦A座4层');
insert into place(province,placename)values('杭州市','浙江省杭州市六元桥中电发展大厦A座6层');
insert into place(province,placename)values('上海市','上海市朝阳区七元桥中电发展大厦B座7层');
insert into place(province,placename)values('武汉市','湖北省武汉市七元桥中电发展大厦C座7层');

-- 2.管理员信息表
create table admin(
 id  int unsigned  key auto_increment,
 adminname  char(20) unique,
 adminpwd   char(32),
 placeid  int unsigned
);
insert into admin(adminname,adminpwd,placeid)values('马西骑','123456',1);
insert into admin(adminname,adminpwd,placeid)values('周玉洁','123456',2);
insert into admin(adminname,adminpwd,placeid)values('邓志','123456',3);
insert into admin(adminname,adminpwd,placeid)values('扬江','123456',4);
insert into admin(adminname,adminpwd,placeid)values('余星','123456',5);
insert into admin(adminname,adminpwd,placeid)values('孙伟平','123456',6);

-- 3.用户信息表
create table user(
id int unsigned  key auto_increment,
username char(32) unique,
userpwd char(32),
truename char(20) not null default '未填写',
telephone bigint not null,
birthday bigint(10) unsigned not null default 0,
sex varchar(10) not null,
qq varchar(15) not null default '未填写',
wechat varchar(32) not null default '未填写',
height smallint unsigned not null,
weight smallint unsigned not null,
addr varchar(50) not null,
trustworthiness tinyint(1) not null default 0,
bankid bigint unsigned not null unique
);
insert into user(username,userpwd,telephone,sex,height,weight,bankid,addr)
values
('a123456','123456','15580026494','男',175,140,6217855000004131611,'湖北省武汉市七元桥中电发展大厦C座7层');





-- 4.用户浏览记录
create table browse(
    browseid  int unsigned key auto_increment,
    userid int unsigned not null,/*用户ID*/
    productid int unsigned not null,/*产品ID*/
    flag tinyint(1) not null default 0 ,/*是否购买*/
);
insert into browse(userid,productid)
values
(1,1),
(1,2),
(3,3),
(2,4),
(3,1),
(2,2),
(2,3),
(3,4),
(5,5),
(4,1),
(1,2),
(2,3),
(6,4),
(3,5),
(5,7),
(5,6),
(1,5),
(3,4);




-- 5.支付密码表
create table pay(
    id int unsigned key auto_increment,
    userid int unsigned not null,
    bankid bigint unsigned not null unique,
    pwd  char(32) not null
);
insert into pay(userid,bankid,pwd)
values
(1,6217855000004131611,'654321'),
(2,6217855000004131612,'654321'),
(3,6217855000004131613,'654321'),
(4,6217855000004131614,'654321'),
(5,6217855000004131615,'654321'),
(6,6217855000004131616,'654321');

-- 6.消息表
create table message(
    id int unsigned key auto_increment,
    userid int default 0,
    content text not null
);
insert into message(content)
values
('恭喜您，已成为MOZAR会员');


-- 7.轮播表
create table lunbo
(
   picid int primary key auto_increment,
   picpath varchar(100),
   link varchar(100),
   des varchar(32) not null
);
insert into lunbo(picpath,link,des)values('public/picture/lunbo/1.jpg','https://www.baidu.com/','轮播'),('public/picture/lunbo/2.jpg','https://www.qq.com/','轮播'),('public/picture/lunbo/3.jpg','https://www.sina.com/','轮播');




-- 8 主页图片表
create table indexpic(
    picid int primary key auto_increment,
    picpath varchar(100),
    des varchar(32) not null,
    sort tinyint(1) not null,
    size tinyint(1) not null,
    pinpid int
);
insert into indexpic(picpath,sort,size,des,pinpid)
  values
  ('public/picture/index/1.JPG',1,1,'男装大图',29),
  ('public/picture/index/2.PNG',1,2,'男装小图',30),
  ('public/picture/index/3.PNG',1,2,'男装小图',36),
  ('public/picture/index/4.JPG',1,2,'男装小图',35),
  ('public/picture/index/5.PNG',1,2,'男装小图',32),
  ('public/picture/index/6.PNG',2,1,'女装',17),
  ('public/picture/index/7.PNG',2,1,'女装',20),
  ('public/picture/index/8.PNG',2,1,'女装',22),
  ('public/picture/index/9.PNG',2,1,'女装',26),
  ('public/picture/index/10.JPG',3,1,'箱包大图',55),
  ('public/picture/index/11.JPG',3,2,'箱包小图',56),
    ('public/picture/index/12.JPG',4,1,'潮鞋大图',50),
      ('public/picture/index/13.JPG',4,1,'潮鞋大图',51),
    ('public/picture/index/14.JPG',4,1,'潮鞋大图',52);


-- 9 代售表
create table daishou(
    id int unsigned primary key auto_increment,
    placeid int unsigned not null,
    name varchar(32) not null,
    buytime varchar(100) not null,
    saleprice float(7,2) not null,
    userid int unsigned not null ,
    height smallint unsigned not null,
    weight smallint unsigned not null,
    result varchar(200) not null,
    link  bigint not null,
    bankid bigint not null,
    sex varchar(3) not null,
    buyprice float(7,2) not null,
    state varchar(32) not null default '未收货'
);


-- 10 代售图片表
create table dspic(
    picid int unsigned primary key auto_increment,
    picpath varchar(100) not null unique,
    id int not null
);




-- 11 产品表
create table product(
     id int unsigned primary key auto_increment,
     name varchar(32) not null,
     height smallint unsigned not null,
     weight smallint unsigned not null,
    buytime varchar(100) not null,
    result varchar(200) not null,
    pinpid  int not null,
    userid int not null,
    placeid int not null,
    sendtime timestamp  default current_timestamp,
     buyprice varchar(32) not null,
     saleprice varchar(32) not null,
    daishouid int UNSIGNED not null UNIQUE ,
     state varchar(32) not null default '正在出售'
);

insert into product(name,height,weight,buytime,result,pinpid,userid,placeid,buyprice,saleprice,daishouid,state)
values
('巧克力男士外套',182,135,'2016年5月31日','买小了','29','1','2','100元','90元',2,'正在销售');
insert into product(name,height,weight,buytime,result,pinpid,userid,placeid,buyprice,saleprice,daishouid,state)
values
  ('巧克力男士外套',182,135,'2016年5月31日','买小了','30','1','2','100元','90元',3,'正在销售');


-- 12 图片表
create table productimage(
	picid int unsigned key auto_increment,
	imagepath char(50) not null unique,
	productid int unsigned,
        bj int default 0
);

insert into productimage(imagepath,productid,bj)
values
('public/picture/small/01.JPG',1,1),
('public/picture/small/02.JPG',1,0),
('public/picture/small/03.JPG',1,0),
('public/picture/small/04.JPG',1,0),
('public/picture/small/05.JPG',1,0),
('public/picture/small/06.JPG',1,0),
('public/picture/mid/01.JPG',1,1),
('public/picture/small/07.JPG',2,1),
('public/picture/small/08.JPG',2,0),
('public/picture/small/09.JPG',2,0),
('public/picture/small/10.JPG',2,0),
('public/picture/small/11.JPG',2,0),
('public/picture/small/12.JPG',2,0),
('public/picture/mid/07.JPG',2,1);

-- 13 订单
create table orders(
    id int unsigned key auto_increment,
    productid int not null,
    userid int not null,
    placeid int not null,
    buyprice float(7,2) not null,
    daishouid int UNSIGNED not null UNIQUE ,
    state varchar(32) not null default '未发货'
);


-- 14 品牌表
create table brand(
id int unsigned key auto_increment,	
bname char(20) not null,
chiname varchar(32) not null,
start tinyint(1) unsigned not null default 0,
pid int not null
);
insert brand(bname,chiname,pid)
value
('girly','女装',0),
('boyy','男装',0),
('foot','潮鞋',0),
('box','箱包',0),
('wai','外套',1),
('wai','裤子',1),
('wai','鞋子',1),
('wai','外套',2),
('wai','裤子',2),
('wai','鞋子',2),
('wai','商务鞋',3),
('wai','运动鞋',3),
('wai','韩版鞋',3),
('wai','手提包',4),
('wai','钱包',4),
('wai','旅行箱',4);
insert into brand(bname,chiname,start,pid)
values
('Nike','耐克',10,5),
('CONVERSE','匡威',10,5),
('vans','万斯',10,5),
('Adidas','阿迪达斯',10,5),
('Nike','耐克',10,6),
('Adidas','阿迪达斯',10,6),
('Versace','范思哲',10,6),
('Prada','普拉达',10,6),
('Calvin klein','卡尔文.克莱恩',10,7),
('Burberry','巴宝莉',10,7),
('Cerruti','切瑞蒂',10,7),
('Valentino','华伦天奴',10,7),
('Chocolate','巧克力',10,8),
('Nike','耐克',10,8),
('Adidas','阿迪达斯',10,8),
('Puma','彪马',10,8),
('Nike','耐克',10,9),
('Levies','李维斯',10,9),
('Adidas','阿迪达斯',10,9),
('Evisu','牛仔裤',10,9),
('Nike','耐克',10,10),
('Vans','万斯',10,10),
('Adidas','阿迪达斯',10,10),
('CONVERSE','匡威',10,10),
('Nike','耐克',10,11),
('Vans','万斯',10,11),
('Adidas','阿迪达斯',10,11),
('CONVERSE','匡威',10,11),
('Nike','耐克',10,12),
('Puma','彪马',10,12),
('Adidas','阿迪达斯',10,12),
('LiNing','李宁',10,12),
('Nike','耐克',10,13),
('Puma','彪马',10,13),
('Adidas','阿迪达斯',10,13),
('CONVERSE','匡威',10,13),
('FENDI','芬迪',10,14),
('COACH','蔻驰',10,14),
('LV','路易威登',10,14),
('CHANNEL','香耐尔',10,14),
('LV','路易威登',10,15),
('COACH','蔻驰',10,15),
('Nike','耐克',10,15),
('COACH','蔻驰',10,15),
('Samsonite','新秀丽',10,16),
('LV','路易威登',10,16),
('Lancel','兰资',10,16),
('Diplomat','外交官',10,16);


