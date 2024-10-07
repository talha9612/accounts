

CREATE TABLE `accountsbks` (
  `acc_ID` int(50) NOT NULL AUTO_INCREMENT,
  `acc_title` varchar(100) NOT NULL,
  `acc_number` varchar(150) NOT NULL,
  `acc_type` varchar(50) NOT NULL,
  `acc_balance` varchar(250) NOT NULL,
  `acc_opbalance` varchar(250) NOT NULL,
  `bk_branch_code` varchar(100) NOT NULL,
  `bk_name` varchar(100) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`acc_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO accountsbks VALUES("1","Faran Waseem","0184-4051","Faran Waseem","140000.28","5900.08","0184","MCB Bank","15-Mar-2019 12:12 PM","25-Mar-2019 11:55 AM");
INSERT INTO accountsbks VALUES("2","Waleed Ahmad","0184-4056","Current","36000","6500","0184","MCB Bank","15-Mar-2019 12:16 PM","15-Mar-2019 12:16 PM");



CREATE TABLE `bankreceipts` (
  `br_ID` int(11) NOT NULL AUTO_INCREMENT,
  `acc_title` varchar(100) NOT NULL,
  `acc_number` varchar(100) NOT NULL,
  `br_cqnumber` int(11) NOT NULL,
  `br_cqdate` varchar(100) NOT NULL,
  `brv_no` varchar(100) NOT NULL,
  `br_sno` int(11) NOT NULL,
  `br_name` varchar(100) NOT NULL,
  `br_head` int(11) NOT NULL,
  `br_type` varchar(100) NOT NULL,
  `br_description` varchar(150) NOT NULL,
  `br_amount` int(11) NOT NULL,
  `acc_balance` int(100) NOT NULL,
  `br_tag` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`br_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO bankreceipts VALUES("1","Faran Waseem","0184-4051","48548945","2019-04-13","BR-00000","1","Accounts Payable","1","Liability","Test Payable","100","5700","Receipt","12-Apr-2019 10:51:19 AM","12-Apr-2019 10:51:19 AM");
INSERT INTO bankreceipts VALUES("2","Faran Waseem","0184-4051","48548945","2019-04-13","BR-00000","2","Staff Refreshment","11","Expense","Friday Refreshment","100","5800","Receipt","12-Apr-2019 10:51:19 AM","12-Apr-2019 10:51:19 AM");
INSERT INTO bankreceipts VALUES("3","Waleed Ahmad","0184-4056","48548945","2019-04-20","BR-00001","1","Staff Salaries","16","Expense","Test Receivable","6500","13000","Receipt","18-Apr-2019 2:21:29 PM","18-Apr-2019 2:21:29 PM");
INSERT INTO bankreceipts VALUES("4","Faran Waseem","0184-4051","25456562","2019-04-20","BR-00002","0","SAHARA CHEMICALS","0","Asset","Test Receivable","100000","104000","Receipt","18-Apr-2019 2:39:42 PM","18-Apr-2019 2:39:42 PM");
INSERT INTO bankreceipts VALUES("5","Waleed Ahmad","0184-4056","0","0","JV-00002","0","","0","Asset","Test Receivable","9000","22000","Receipt","26-Apr-2019 2:45:20 PM","26-Apr-2019 2:45:20 PM");
INSERT INTO bankreceipts VALUES("6","Waleed Ahmad","0184-4056","0","0","JV-00003","0","","0","Asset","Test Receivable","10000","32000","Receipt","30-Apr-2019 11:18:34 AM","30-Apr-2019 11:18:34 AM");
INSERT INTO bankreceipts VALUES("7","Waleed Ahmad","0184-4056","0","0","JV-00005","0","","0","Asset","Test Receivable","4000","36000","Receipt","03-May-2019 10:46:59 AM","03-May-2019 10:46:59 AM");
INSERT INTO bankreceipts VALUES("8","Faran Waseem","0184-4051","0","0","BR-00003","0","SAHARA CHEMICALS","0","Asset","Test Description","90000","140000","Receipt","03-Jun-2019 11:31:12 AM","03-Jun-2019 11:31:12 AM");



CREATE TABLE `banks` (
  `bk_ID` int(50) NOT NULL AUTO_INCREMENT,
  `bk_name` varchar(100) NOT NULL,
  `bk_branch_code` varchar(100) NOT NULL,
  `bk_address` varchar(150) NOT NULL,
  `bk_phone` bigint(11) unsigned zerofill NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`bk_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO banks VALUES("1","MCB Bank","0184","Mcload Road Lahore","03237806378","2019-03-15 07:11:20","2019-03-15 07:11:20");



CREATE TABLE `banktransactions` (
  `bt_ID` int(50) NOT NULL AUTO_INCREMENT,
  `bkvr_no` varchar(100) NOT NULL,
  `acc_title` varchar(150) NOT NULL,
  `acc_number` varchar(100) NOT NULL,
  `bt_cqnumber` int(50) NOT NULL,
  `bt_cqdate` varchar(100) NOT NULL,
  `bt_sno` int(50) NOT NULL,
  `ex_ID` int(50) NOT NULL,
  `ex_type` varchar(50) NOT NULL,
  `ex_name` varchar(100) NOT NULL,
  `bt_description` varchar(150) NOT NULL,
  `bt_amount` int(50) NOT NULL,
  `acc_balance` int(100) NOT NULL,
  `bt_tag` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`bt_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO banktransactions VALUES("1","BT-00000","Faran Waseem","0184-4051","48548945","2019-04-12","1","1","Liability","Accounts Payable","Test Payable","100","5800","Payment","12-Apr-2019 10:46:13 AM","12-Apr-2019 10:46:13 AM");
INSERT INTO banktransactions VALUES("2","BT-00000","Faran Waseem","0184-4051","48548945","2019-04-12","2","11","Expense","Staff Refreshment","Test Payable","100","5700","Payment","12-Apr-2019 10:46:13 AM","12-Apr-2019 10:46:13 AM");
INSERT INTO banktransactions VALUES("3","BT-00000","Faran Waseem","0184-4051","48548945","2019-04-12","3","12","Income","Gross Income","Friday Refreshment","100","5600","Payment","12-Apr-2019 10:46:13 AM","12-Apr-2019 10:46:13 AM");
INSERT INTO banktransactions VALUES("4","BT-00001","Faran Waseem","0184-4051","48548945","2019-04-20","1","1","Liability","Accounts Payable","Test Payable","800","5000","Payment","18-Apr-2019 2:22:02 PM","18-Apr-2019 2:22:02 PM");
INSERT INTO banktransactions VALUES("5","BT-00002","Faran Waseem","0184-4051","25456562","2019-04-19","1","1","Liability","Accounts Payable","Test Payable","1000","4000","Payment","18-Apr-2019 2:37:04 PM","18-Apr-2019 2:37:04 PM");
INSERT INTO banktransactions VALUES("6","BT-00003","Faran Waseem","0184-4051","48548945","2019-04-25","1","0","0","Dwyer","Payment against PR-00010","50000","54000","Payment","23-Apr-2019 11:28:59 AM","23-Apr-2019 11:28:59 AM");
INSERT INTO banktransactions VALUES("7","JV-00005","Faran Waseem","0184-4051","0","0","0","0","Liability","","Test Payable","4000","50000","Payment","03-May-2019 10:46:59 AM","03-May-2019 10:46:59 AM");



CREATE TABLE `bkvouchers` (
  `bkvr_ID` int(50) NOT NULL AUTO_INCREMENT,
  `bkvr_no` varchar(100) NOT NULL,
  `acc_title` varchar(100) NOT NULL,
  `acc_number` varchar(100) NOT NULL,
  `bt_cqnumber` varchar(100) NOT NULL,
  `bt_cqdate` varchar(100) NOT NULL,
  `bkvr_amount` int(50) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`bkvr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO bkvouchers VALUES("1","BT-00000","Faran Waseem","0184-4051","48548945","2019-04-12","300","12-Apr-2019 10:46:13 AM","12-Apr-2019 10:46:13 AM");
INSERT INTO bkvouchers VALUES("2","BT-00001","Faran Waseem","0184-4051","48548945","2019-04-20","800","18-Apr-2019 2:22:02 PM","18-Apr-2019 2:22:02 PM");
INSERT INTO bkvouchers VALUES("3","BT-00002","Faran Waseem","0184-4051","25456562","2019-04-19","1000","18-Apr-2019 2:37:04 PM","18-Apr-2019 2:37:04 PM");
INSERT INTO bkvouchers VALUES("4","BT-00003","Faran Waseem","0184-4051","48548945","2019-04-25","50000","23-Apr-2019 11:28:59 AM","23-Apr-2019 11:28:59 AM");



CREATE TABLE `brvouchers` (
  `brv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `brv_no` varchar(100) NOT NULL,
  `acc_title` varchar(100) NOT NULL,
  `acc_number` varchar(100) NOT NULL,
  `br_cqnumber` int(11) NOT NULL,
  `br_cqdate` varchar(100) NOT NULL,
  `brv_amount` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`brv_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO brvouchers VALUES("1","BR-00000","Faran Waseem","0184-4051","48548945","2019-04-13","200","12-Apr-2019 10:51:19 AM","12-Apr-2019 10:51:19 AM");
INSERT INTO brvouchers VALUES("2","BR-00001","Waleed Ahmad","0184-4056","48548945","2019-04-20","6500","18-Apr-2019 2:21:29 PM","18-Apr-2019 2:21:29 PM");
INSERT INTO brvouchers VALUES("3","BR-00002","Faran Waseem","0184-4051","25456562","2019-04-20","100000","18-Apr-2019 2:39:42 PM","18-Apr-2019 2:39:42 PM");
INSERT INTO brvouchers VALUES("4","BR-00003","Faran Waseem","0184-4051","0","0","90000","03-Jun-2019 11:31:12 AM","03-Jun-2019 11:31:12 AM");



CREATE TABLE `cashinhands` (
  `cih_ID` int(50) NOT NULL AUTO_INCREMENT,
  `cih_title` varchar(150) NOT NULL,
  `cih_balance` varchar(200) NOT NULL,
  `cih_obalance` varchar(200) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`cih_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO cashinhands VALUES("1","CIH-FARAN","7000.5","12500.5","2019-03-14 07:37:21","2019-03-25 07:04:44");
INSERT INTO cashinhands VALUES("2","CIH-STAR","494500","500000","2019-03-30 06:43:30","2019-03-30 06:43:30");



CREATE TABLE `cashreceipts` (
  `cr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `cih_title` varchar(100) NOT NULL,
  `crv_no` varchar(100) NOT NULL,
  `cr_sno` int(11) NOT NULL,
  `cr_name` varchar(50) NOT NULL,
  `cr_head` int(11) NOT NULL,
  `cr_type` varchar(100) NOT NULL,
  `cr_description` varchar(100) NOT NULL,
  `cr_amount` int(11) NOT NULL,
  `cih_balance` varchar(100) NOT NULL,
  `cr_tag` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`cr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO cashreceipts VALUES("1","CIH-FARAN","CR-00000","0","SAHARA CHEMICALS","0","Asset","Test Receivable","100000","110000.5","Receipt","11-Apr-2019 10:34:22 AM","11-Apr-2019 10:34:22 AM");
INSERT INTO cashreceipts VALUES("2","CIH-FARAN","CR-00001","1","Accounts Payable","1","Liability","Test Payable","100","36690.5","Receipt","12-Apr-2019 10:48:53 AM","12-Apr-2019 10:48:53 AM");
INSERT INTO cashreceipts VALUES("3","CIH-FARAN","CR-00001","2","Staff Refreshment","11","Expense","Test Payable","100","36790.5","Receipt","12-Apr-2019 10:48:53 AM","12-Apr-2019 10:48:53 AM");
INSERT INTO cashreceipts VALUES("4","CIH-FARAN","CR-00001","3","Gross Income","12","Income","Friday Refreshment","100","36890.5","Receipt","12-Apr-2019 10:48:53 AM","12-Apr-2019 10:48:53 AM");
INSERT INTO cashreceipts VALUES("5","CIH-FARAN","CR-00002","0","SILVER LINKS","0","Asset","Test Receivable","10000","46890.5","Receipt","15-Apr-2019 4:51:13 PM","15-Apr-2019 4:51:13 PM");
INSERT INTO cashreceipts VALUES("6","CIH-FARAN","JV-00000","0","","0","Asset","Test Receivable","30000","76890.5","Receipt","18-Apr-2019 12:32:47 PM","18-Apr-2019 12:32:47 PM");
INSERT INTO cashreceipts VALUES("7","CIH-FARAN","CR-00003","1","Advance Sales","18","Income","Test Receivable","10000","80000.5","Receipt","18-Apr-2019 2:22:43 PM","18-Apr-2019 2:22:43 PM");
INSERT INTO cashreceipts VALUES("8","CIH-STAR","JV-00004","0","","0","Asset","Test Receivable","2000","492000","Receipt","03-May-2019 10:46:21 AM","03-May-2019 10:46:21 AM");
INSERT INTO cashreceipts VALUES("9","CIH-STAR","JV-00011","0","","0","Asset","Test Receivable","2500","494500","Receipt","03-May-2019 10:54:01 AM","03-May-2019 10:54:01 AM");



CREATE TABLE `cashtransactions` (
  `ct_ID` int(50) NOT NULL AUTO_INCREMENT,
  `cih_title` varchar(100) NOT NULL,
  `vr_no` varchar(100) NOT NULL,
  `ct_sno` int(11) NOT NULL,
  `ct_name` varchar(50) NOT NULL,
  `ct_head` int(50) NOT NULL,
  `ct_type` varchar(100) NOT NULL,
  `ct_description` varchar(100) NOT NULL,
  `ct_amount` int(150) NOT NULL,
  `cih_balance` varchar(100) NOT NULL,
  `ct_tag` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`ct_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

INSERT INTO cashtransactions VALUES("1","CIH-FARAN","CT-00000","1","Accounts Payable","1","Liability","Test Payable","500","12000.5","Payment","11-Apr-2019 10:31:48 AM","11-Apr-2019 10:31:48 AM");
INSERT INTO cashtransactions VALUES("2","CIH-FARAN","CT-00001","1","Staff Refreshment","11","Expense","Friday Refreshment","2000","10000.5","Payment","10-Apr-2019 10:31:48 AM","10-Apr-2019 10:31:48 AM");
INSERT INTO cashtransactions VALUES("3","CIH-FARAN","CT-00002","1","Toyota Corolla GLI","9","Asset","Test Description","4000","106000.5","Payment","11-Apr-2019 10:43:49 AM","11-Apr-2019 10:43:49 AM");
INSERT INTO cashtransactions VALUES("4","CIH-FARAN","CT-00003","1","Staff Salaries","16","Expense","Test Payable","60000","46000.5","Payment","01-Apr-2019 10:31:48 AM","01-Apr-2019 10:31:48 AM");
INSERT INTO cashtransactions VALUES("5","CIH-FARAN","CT-00004","1","Accounts Payable","1","Liability","Test Payable","500","45500.5","Payment","11-Apr-2019 5:09:51 PM","11-Apr-2019 5:09:51 PM");
INSERT INTO cashtransactions VALUES("6","CIH-FARAN","CT-00005","1","Accounts Payable","1","Liability","Test Payable","500","45000.5","Payment","11-Apr-2019 5:12:14 PM","11-Apr-2019 5:12:14 PM");
INSERT INTO cashtransactions VALUES("7","CIH-FARAN","CT-00006","1","Accounts Payable","1","Liability","Test Payable","500","44500.5","Payment","11-Apr-2019 5:13:44 PM","11-Apr-2019 5:13:44 PM");
INSERT INTO cashtransactions VALUES("8","CIH-FARAN","CT-00007","1","Accounts Payable","1","Liability","Test Payable","500","44000.5","Payment","11-Apr-2019 5:15:14 PM","11-Apr-2019 5:15:14 PM");
INSERT INTO cashtransactions VALUES("9","CIH-FARAN","CT-00008","1","Gross Income","12","Income","Test Payable","500","43500.5","Payment","11-Apr-2019 5:15:58 PM","11-Apr-2019 5:15:58 PM");
INSERT INTO cashtransactions VALUES("10","CIH-FARAN","CT-00009","1","Toyota Corolla GLI","9","Asset","Friday Refreshment","4000","39500.5","Payment","11-Apr-2019 5:18:20 PM","11-Apr-2019 5:18:20 PM");
INSERT INTO cashtransactions VALUES("11","CIH-FARAN","CT-00010","1","Staff Refreshment","11","Expense","Test Payable","360","39140.5","Payment","12-Apr-2019 10:31:37 AM","12-Apr-2019 10:31:37 AM");
INSERT INTO cashtransactions VALUES("12","CIH-FARAN","CT-00011","1","Accounts Payable","1","Liability","Test Payable","500","38640.5","Payment","12-Apr-2019 10:38:16 AM","12-Apr-2019 10:38:16 AM");
INSERT INTO cashtransactions VALUES("13","CIH-FARAN","CT-00012","1","Accounts Payable","1","Liability","Test Payable","500","38140.5","Payment","12-Apr-2019 10:39:53 AM","12-Apr-2019 10:39:53 AM");
INSERT INTO cashtransactions VALUES("14","CIH-FARAN","CT-00013","1","Staff Refreshment","11","Expense","Test Payable","1000","37140.5","Payment","12-Apr-2019 10:40:26 AM","12-Apr-2019 10:40:26 AM");
INSERT INTO cashtransactions VALUES("15","CIH-FARAN","CT-00014","1","Gross Income","12","Income","Test Payable","250","36890.5","Payment","12-Apr-2019 10:40:55 AM","12-Apr-2019 10:40:55 AM");
INSERT INTO cashtransactions VALUES("16","CIH-FARAN","CT-00015","1","Accounts Payable","1","Liability","Test Payable","100","36790.5","Payment","12-Apr-2019 10:42:55 AM","12-Apr-2019 10:42:55 AM");
INSERT INTO cashtransactions VALUES("17","CIH-FARAN","CT-00015","2","Gross Income","12","Income","Test Payable","100","36690.5","Payment","12-Apr-2019 10:42:55 AM","12-Apr-2019 10:42:55 AM");
INSERT INTO cashtransactions VALUES("18","CIH-FARAN","CT-00015","3","Staff Refreshment","11","Expense","Friday Refreshment","100","36590.5","Payment","12-Apr-2019 10:42:55 AM","12-Apr-2019 10:42:55 AM");
INSERT INTO cashtransactions VALUES("19","CIH-FARAN","CT-00016","1","Accounts Payable","1","Liability","Test Payable","6890","70000.5","Payment","18-Apr-2019 2:03:15 PM","18-Apr-2019 2:03:15 PM");
INSERT INTO cashtransactions VALUES("20","CIH-FARAN","CT-00017","1","Accounts Payable","1","Liability","Test Payable","1000","79000.5","Payment","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO cashtransactions VALUES("21","CIH-FARAN","CT-00017","2","Toyota Corolla GLI","9","Asset","Friday Refreshment","2000","77000.5","Payment","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO cashtransactions VALUES("22","CIH-FARAN","CT-00017","3","Staff Refreshment","11","Expense","Test Receivable","3000","74000.5","Payment","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO cashtransactions VALUES("23","CIH-FARAN","CT-00017","4","Gross Income","12","Income","Car Maintenance","4000","70000.5","Payment","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO cashtransactions VALUES("24","CIH-FARAN","CT-00017","5","Guests Refreshment","13","Expense","Test Description","5000","65000.5","Payment","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO cashtransactions VALUES("25","CIH-FARAN","CT-00017","6","Guests Refreshment","13","Expense","Test Description","6000","59000.5","Payment","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO cashtransactions VALUES("26","CIH-STAR","JV-00001","0","","0","Liability","Test Payable","10000","490000","Payment","23-Apr-2019 11:33:08 AM","23-Apr-2019 11:33:08 AM");
INSERT INTO cashtransactions VALUES("27","CIH-FARAN","JV-00001","0","","0","Liability","Test Payable","10000","49000.5","Payment","23-Apr-2019 11:33:08 AM","23-Apr-2019 11:33:08 AM");
INSERT INTO cashtransactions VALUES("28","CIH-FARAN","JV-00002","0","","0","Liability","Test Payable","9000","40000.5","Payment","26-Apr-2019 2:45:20 PM","26-Apr-2019 2:45:20 PM");
INSERT INTO cashtransactions VALUES("29","CIH-FARAN","JV-00003","0","","0","Liability","Test Payable","10000","30000.5","Payment","30-Apr-2019 11:18:34 AM","30-Apr-2019 11:18:34 AM");
INSERT INTO cashtransactions VALUES("30","CIH-FARAN","CT-00018","1","Accounts Payable","1","Liability","Test Payable","1000","29000.5","Payment","02-May-2019 3:23:02 PM","02-May-2019 3:23:02 PM");
INSERT INTO cashtransactions VALUES("31","CIH-FARAN","CT-00018","2","Toyota Corolla GLI","9","Asset","Test Payable","2000","27000.5","Payment","02-May-2019 3:23:02 PM","02-May-2019 3:23:02 PM");
INSERT INTO cashtransactions VALUES("32","CIH-FARAN","CT-00018","3","Staff Refreshment","11","Expense","Test Payable","3000","24000.5","Payment","02-May-2019 3:23:02 PM","02-May-2019 3:23:02 PM");
INSERT INTO cashtransactions VALUES("33","CIH-FARAN","CT-00018","4","Gross Income","12","Income","Test Payable","4000","20000.5","Payment","02-May-2019 3:23:02 PM","02-May-2019 3:23:02 PM");
INSERT INTO cashtransactions VALUES("34","CIH-FARAN","JV-00004","0","","0","Liability","Test Payable","2000","18000.5","Payment","03-May-2019 10:46:21 AM","03-May-2019 10:46:21 AM");
INSERT INTO cashtransactions VALUES("35","CIH-FARAN","JV-00008","0","","0","Liability","Test Payable","8000","10000.5","Payment","03-May-2019 10:49:41 AM","03-May-2019 10:49:41 AM");
INSERT INTO cashtransactions VALUES("36","CIH-FARAN","JV-00011","0","","0","Liability","Test Payable","2500","7500.5","Payment","03-May-2019 10:54:01 AM","03-May-2019 10:54:01 AM");
INSERT INTO cashtransactions VALUES("37","CIH-FARAN","JV-00012","0","","0","Liability","Test Payable","500","7000.5","Payment","03-May-2019 11:09:32 AM","03-May-2019 11:09:32 AM");



CREATE TABLE `crvouchers` (
  `crv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `crv_no` varchar(100) NOT NULL,
  `cih_title` varchar(100) NOT NULL,
  `crv_amount` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`crv_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO crvouchers VALUES("1","CR-00000","CIH-FARAN","100000","11-Apr-2019 10:34:22 AM","11-Apr-2019 10:34:22 AM");
INSERT INTO crvouchers VALUES("2","CR-00001","CIH-FARAN","300","12-Apr-2019 10:48:53 AM","12-Apr-2019 10:48:53 AM");
INSERT INTO crvouchers VALUES("3","CR-00002","CIH-FARAN","10000","15-Apr-2019 4:51:13 PM","15-Apr-2019 4:51:13 PM");
INSERT INTO crvouchers VALUES("4","CR-00003","CIH-FARAN","10000","18-Apr-2019 2:22:43 PM","18-Apr-2019 2:22:43 PM");



CREATE TABLE `ctvouchers` (
  `vr_ID` int(50) NOT NULL AUTO_INCREMENT,
  `vr_no` varchar(100) NOT NULL,
  `vr_amount` int(100) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`vr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO ctvouchers VALUES("1","CT-00000","500","11-Apr-2019 10:31:48 AM","11-Apr-2019 10:31:48 AM");
INSERT INTO ctvouchers VALUES("2","CT-00001","2000","10-Apr-2019","10-Apr-2019");
INSERT INTO ctvouchers VALUES("3","CT-00002","4000","11-Apr-2019 10:43:49 AM","11-Apr-2019 10:43:49 AM");
INSERT INTO ctvouchers VALUES("4","CT-00003","60000","01-Apr-2019","01-Apr-2019");
INSERT INTO ctvouchers VALUES("5","CT-00004","500","11-Apr-2019 5:09:51 PM","11-Apr-2019 5:09:51 PM");
INSERT INTO ctvouchers VALUES("6","CT-00005","500","11-Apr-2019 5:12:14 PM","11-Apr-2019 5:12:14 PM");
INSERT INTO ctvouchers VALUES("7","CT-00006","500","11-Apr-2019 5:13:44 PM","11-Apr-2019 5:13:44 PM");
INSERT INTO ctvouchers VALUES("8","CT-00007","500","11-Apr-2019 5:15:14 PM","11-Apr-2019 5:15:14 PM");
INSERT INTO ctvouchers VALUES("9","CT-00008","500","11-Apr-2019 5:15:58 PM","11-Apr-2019 5:15:58 PM");
INSERT INTO ctvouchers VALUES("10","CT-00009","4000","11-Apr-2019 5:18:20 PM","11-Apr-2019 5:18:20 PM");
INSERT INTO ctvouchers VALUES("11","CT-00010","360","12-Apr-2019 10:31:37 AM","12-Apr-2019 10:31:37 AM");
INSERT INTO ctvouchers VALUES("12","CT-00011","500","12-Apr-2019 10:38:16 AM","12-Apr-2019 10:38:16 AM");
INSERT INTO ctvouchers VALUES("13","CT-00012","500","12-Apr-2019 10:39:53 AM","12-Apr-2019 10:39:53 AM");
INSERT INTO ctvouchers VALUES("14","CT-00013","1000","12-Apr-2019 10:40:26 AM","12-Apr-2019 10:40:26 AM");
INSERT INTO ctvouchers VALUES("15","CT-00014","250","12-Apr-2019 10:40:55 AM","12-Apr-2019 10:40:55 AM");
INSERT INTO ctvouchers VALUES("16","CT-00015","300","12-Apr-2019 10:42:55 AM","12-Apr-2019 10:42:55 AM");
INSERT INTO ctvouchers VALUES("17","CT-00016","6890","18-Apr-2019 2:03:15 PM","18-Apr-2019 2:03:15 PM");
INSERT INTO ctvouchers VALUES("18","CT-00017","21000","22-Apr-2019 3:06:50 PM","22-Apr-2019 3:06:50 PM");
INSERT INTO ctvouchers VALUES("19","CT-00018","10000","02-May-2019 3:23:02 PM","02-May-2019 3:23:02 PM");



CREATE TABLE `exptypes` (
  `tp_ID` int(11) NOT NULL AUTO_INCREMENT,
  `tp_name` varchar(100) NOT NULL,
  `tp_type` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`tp_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO exptypes VALUES("1","Payables","Liability","25-Mar-2019 10:50 AM","25-Mar-2019 10:50 AM");
INSERT INTO exptypes VALUES("3","Refreshment","Expense","25-Mar-2019 3:07 PM","25-Mar-2019 3:07 PM");
INSERT INTO exptypes VALUES("4","Current Asset","Asset","26-Mar-2019 11:04 AM","26-Mar-2019 11:04 AM");
INSERT INTO exptypes VALUES("5","Maintenance Expense","Expense","08-Apr-2019 4:18 PM","08-Apr-2019 4:18 PM");
INSERT INTO exptypes VALUES("6","Administrative Expense","Expense","08-Apr-2019 4:18 PM","08-Apr-2019 4:18 PM");
INSERT INTO exptypes VALUES("7","Import Sale","Income","12-Apr-2019 11:32 AM","12-Apr-2019 11:32 AM");
INSERT INTO exptypes VALUES("8","Cost of Goods","Expense","28-May-2019 11:09 AM","28-May-2019 11:09 AM");
INSERT INTO exptypes VALUES("9","Administrative Expenses","Expense","31-May-2019 1:43 PM","31-May-2019 1:43 PM");
INSERT INTO exptypes VALUES("10","Marketing Expenses","Expense","31-May-2019 1:53 PM","31-May-2019 1:53 PM");
INSERT INTO exptypes VALUES("11","Financial Expenses","Expense","31-May-2019 2:06 PM","31-May-2019 2:06 PM");



CREATE TABLE `farmers` (
  `fr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fr_name` varchar(50) NOT NULL,
  `fr_fname` varchar(50) NOT NULL,
  `fr_gst` varchar(150) NOT NULL,
  `fr_address` varchar(250) NOT NULL,
  `fr_cnic` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `fr_phone` bigint(11) unsigned zerofill NOT NULL,
  `fr_city` varchar(50) NOT NULL,
  `fr_duedate` varchar(250) NOT NULL,
  `fr_balance` varchar(250) NOT NULL,
  `fr_opbalance` varchar(250) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`fr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO farmers VALUES("9","SILVER LINKS","Tanveer Hussain","987420-2","Devis Road Lahore","23568-9","03237806378","Lahore","19-Apr-2019","17847150","130000","13-Mar-2019 10:44 AM","18-Jun-2019 4:33 PM");
INSERT INTO farmers VALUES("10","SAHARA CHEMICALS","--","987420-22","Sheikhupura Road Lahore","23568-99","03219656897","Lahore","29-Mar-2019","910999.8","250000","13-Mar-2019 10:52 AM","05-Apr-2019 10:21 AM");
INSERT INTO farmers VALUES("12","Mayfair INC","--","987420-1","Kot Lakhpat Industrial State Lahore","23568-8","03237806378","Lahore","21-Nov-2019","1400000","1200000","05-Apr-2019 11:32 AM","05-Apr-2019 11:33 AM");



CREATE TABLE `fpayments` (
  `fp_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fr_name` varchar(100) NOT NULL,
  `fr_ID` varchar(100) NOT NULL,
  `fr_cnic` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `fp_amount` varchar(100) NOT NULL,
  `fp_description` varchar(200) NOT NULL,
  `vr_number` varchar(150) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`fp_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO fpayments VALUES("1","SAHARA CHEMICALS","10","23568-99","100000","Test Receivable","CR-00000","15-Apr-2019 ","15-Apr-2019 ");
INSERT INTO fpayments VALUES("2","SILVER LINKS","9","23568-9","10000","Test Receivable","CR-00002","05-Feb-2019 ","05-Feb-2019 ");
INSERT INTO fpayments VALUES("3","SAHARA CHEMICALS","10","23568-99","100000","Test Receivable","BR-00002","18-Apr-2019 ","18-Apr-2019 ");
INSERT INTO fpayments VALUES("4","SAHARA CHEMICALS","10","23568-99","90000.2","Test Description","BR-00003","03-Jun-2019 11:31:12 AM","03-Jun-2019 11:31:12 AM");



CREATE TABLE `gateinwards` (
  `gi_ID` int(11) NOT NULL AUTO_INCREMENT,
  `gi_number` varchar(150) NOT NULL,
  `gi_name` varchar(100) NOT NULL,
  `gi_title` varchar(200) NOT NULL,
  `gi_area` varchar(100) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `gi_supplier` varchar(100) NOT NULL,
  `gi_item` varchar(100) NOT NULL,
  `gi_size` varchar(100) NOT NULL,
  `gi_specs` varchar(150) NOT NULL,
  `gi_description` varchar(200) NOT NULL,
  `gi_quantity` varchar(100) NOT NULL,
  `gi_received_by` varchar(100) NOT NULL,
  `gi_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`gi_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO gateinwards VALUES("9","PR-00000","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","60","Kashif Shamsuddin","1","22-Mar-2019","22-Mar-2019");
INSERT INTO gateinwards VALUES("10","PR-00001","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","150","Kashif Shamsuddin","1","05-Apr-2019","05-Apr-2019");
INSERT INTO gateinwards VALUES("11","PR-00002","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","200","Kashif Shamsuddin","1","11-Apr-2019","11-Apr-2019");
INSERT INTO gateinwards VALUES("12","PR-00003","Kashif Shamsuddin","Request for Instruments","-","xyz","2","Azbil","Azbil","Controller","NX","NX 70","test description","100","Kashif Shamsuddin","1","05-Apr-2019","05-Apr-2019");
INSERT INTO gateinwards VALUES("13","PR-00004","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","Kashif Shamsuddin","1","06-Apr-2019","06-Apr-2019");
INSERT INTO gateinwards VALUES("14","PR-00005","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","100","Kashif Shamsuddin","1","06-Apr-2019","06-Apr-2019");
INSERT INTO gateinwards VALUES("15","PR-00006","Kashif Shamsuddin","Request for Instruments","-","xyz","2","Azbil","Azbil","Controller","NX","NX 70","--","150","Kashif Shamsuddin","1","06-Apr-2019","06-Apr-2019");
INSERT INTO gateinwards VALUES("16","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description","100","Kashif Shamsuddin","1","11-Apr-2019","11-Apr-2019");
INSERT INTO gateinwards VALUES("17","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","Kashif Shamsuddin","1","11-Apr-2019","11-Apr-2019");
INSERT INTO gateinwards VALUES("18","PR-00010","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","Kashif Shamsuddin","0","24-Apr-2019","24-Apr-2019");
INSERT INTO gateinwards VALUES("19","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","50","Kashif Shamsuddin","1","31-May-2019","31-May-2019");
INSERT INTO gateinwards VALUES("20","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description 2","100","Kashif Shamsuddin","1","31-May-2019","31-May-2019");
INSERT INTO gateinwards VALUES("21","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Kinda","VFD","VX-100","test specs","test description 3","150","Kashif Shamsuddin","1","31-May-2019","31-May-2019");
INSERT INTO gateinwards VALUES("22","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","China","Office Chair","-","Comfortable Chair for long sittings","test description 4","200","Kashif Shamsuddin","1","31-May-2019","31-May-2019");



CREATE TABLE `gateoutwards` (
  `go_ID` int(11) NOT NULL AUTO_INCREMENT,
  `go_number` varchar(200) NOT NULL,
  `dc_number` varchar(150) NOT NULL,
  `fr_ID` varchar(100) NOT NULL,
  `fr_name` varchar(150) NOT NULL,
  `fr_cnic` varchar(200) NOT NULL,
  `go_title` varchar(200) NOT NULL,
  `go_name` varchar(100) NOT NULL,
  `go_area` varchar(200) NOT NULL,
  `lot_number` varchar(150) NOT NULL,
  `go_item` varchar(100) NOT NULL,
  `go_size` varchar(100) NOT NULL,
  `go_quantity` varchar(100) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`go_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO gateoutwards VALUES("10","SR-00000","00000/2019","9","SILVER LINKS","23568-9","Request for instruments supply","Kashif Shamsuddin","-","LT-00000","Magnehalic Gauge","Mark |||","18","22-Mar-2019","22-Mar-2019");
INSERT INTO gateoutwards VALUES("11","SR-00000","00000/2019","9","SILVER LINKS","23568-9","Request for instruments supply","Kashif Shamsuddin","-","LT-00000","Controller","NX","11","22-Mar-2019","22-Mar-2019");
INSERT INTO gateoutwards VALUES("12","SR-00000","00000/2019","9","SILVER LINKS","23568-9","Request for instruments supply","Kashif Shamsuddin","-","LT-00000","VFD","VX-100","21","22-Mar-2019","22-Mar-2019");
INSERT INTO gateoutwards VALUES("13","SR-00001","00001/2019","11","Waleed Sons","214578","Request for instruments","Kashif Shamsuddin","-","LT-00000","Magnehalic Gauge","Mark |||","20","29-Mar-2019","29-Mar-2019");
INSERT INTO gateoutwards VALUES("14","SR-00002","00002/2019","9","SILVER LINKS","23568-9","Request for instruments supply","Kashif Shamsuddin","-","LT-00004","Magnehalic Gauge","Mark |||","60","05-Apr-2019","05-Apr-2019");
INSERT INTO gateoutwards VALUES("15","SR-00003","00003/2019","9","SILVER LINKS","23568-9","Request for instruments","Kashif Shamsuddin","-","LT-00000","Controller","NX","10","05-Apr-2019","05-Apr-2019");
INSERT INTO gateoutwards VALUES("16","SR-00004","00004/2019","10","SAHARA CHEMICALS","23568-99","Request for instruments","Kashif Shamsuddin","-","LT-00005","Magnehalic Gauge","Mark |||","30","05-Apr-2019","05-Apr-2019");
INSERT INTO gateoutwards VALUES("17","SR-00005","00005/2019","9","SILVER LINKS","23568-9","Request for instruments supply","Kashif Shamsuddin","-","LT-00000","Controller","NX","10","18-Jun-2019 1:20:19 PM","18-Jun-2019 1:20:19 PM");
INSERT INTO gateoutwards VALUES("18","SR-00005","00005/2019","9","SILVER LINKS","23568-9","Request for instruments supply","Kashif Shamsuddin","-","LT-00005","Magnehalic Gauge","Mark |||","5","18-Jun-2019 1:20:19 PM","18-Jun-2019 1:20:19 PM");
INSERT INTO gateoutwards VALUES("19","SR-00006","00006/2019","9","SILVER LINKS","23568-9","Request for instruments sale","Kashif Shamsuddin","-","LT-00012","Magnehalic Gauge","Mark |||","20","18-Jun-2019 4:33:04 PM","18-Jun-2019 4:33:04 PM");
INSERT INTO gateoutwards VALUES("20","SR-00006","00006/2019","9","SILVER LINKS","23568-9","Request for instruments sale","Kashif Shamsuddin","-","LT-00012","Controller","NX","25","18-Jun-2019 4:33:04 PM","18-Jun-2019 4:33:04 PM");
INSERT INTO gateoutwards VALUES("21","SR-00006","00006/2019","9","SILVER LINKS","23568-9","Request for instruments sale","Kashif Shamsuddin","-","LT-00000","VFD","VX-100","30","18-Jun-2019 4:33:04 PM","18-Jun-2019 4:33:04 PM");



CREATE TABLE `guaranters` (
  `gr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `gr_name` varchar(50) NOT NULL,
  `gr_fname` varchar(50) NOT NULL,
  `gr_gender` varchar(50) NOT NULL,
  `gr_address` varchar(250) NOT NULL,
  `gr_cnic` bigint(13) unsigned zerofill NOT NULL,
  `gr_phone` bigint(11) unsigned zerofill NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`gr_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `heads` (
  `h_ID` int(11) NOT NULL AUTO_INCREMENT,
  `h_name` varchar(100) NOT NULL,
  `h_type` varchar(100) NOT NULL,
  `h_stype` varchar(100) NOT NULL,
  `h_opbalance` varchar(150) NOT NULL,
  `h_balance` varchar(150) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`h_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO heads VALUES("1","Accounts Payable","Liability","Payables","120000","100620","2019-03-25 05:51:08","2019-03-25 05:51:08");
INSERT INTO heads VALUES("9","Toyota Corolla GLI","Asset","Current Asset","2100000","2184810","2019-03-26 06:05:10","2019-03-26 06:05:10");
INSERT INTO heads VALUES("11","Staff Refreshment","Expense","Refreshment","66000","118500","2019-03-26 06:09:58","2019-03-26 06:12:08");
INSERT INTO heads VALUES("12","Gross Income","Income","Purchase Returns","59000","118900","2019-03-26 06:13:46","2019-03-26 06:15:48");
INSERT INTO heads VALUES("13","Guests Refreshment","Expense","Refreshment","4000","23000","2019-04-08 11:19:02","2019-04-08 11:19:02");
INSERT INTO heads VALUES("14","Office Stationary","Expense","Administrative Expense","8000","8000","2019-04-08 11:19:47","2019-04-08 11:19:47");
INSERT INTO heads VALUES("15","Office Pc's","Expense","Administrative Expense","20000","20000","2019-04-08 11:20:13","2019-04-08 11:20:13");
INSERT INTO heads VALUES("16","Staff Salaries","Expense","Administrative Expense","500000","553500","2019-04-08 11:20:29","2019-04-08 11:20:29");
INSERT INTO heads VALUES("17","Office Furniture Repair","Expense","Maintenance Expense","68000","68000","2019-04-08 11:20:58","2019-04-08 11:21:14");
INSERT INTO heads VALUES("18","Advance Sales","Income","Import Sale","1000000","1010000","2019-04-12 06:33:23","2019-04-12 06:33:23");
INSERT INTO heads VALUES("19","Sales Return","Expense","Cost of Goods","52000","52000","2019-05-28 06:10:37","2019-05-28 06:10:37");
INSERT INTO heads VALUES("20","Purchase Return","Income","Select","65000","65000","2019-05-28 06:54:02","2019-05-28 06:54:02");
INSERT INTO heads VALUES("21","Local Purchases","Expense","Cost of Goods","25000","25000","2019-05-28 07:07:56","2019-05-28 07:07:56");
INSERT INTO heads VALUES("22","Import Purchase","Expense","Cost of Goods","98000","98000","2019-05-28 07:08:11","2019-05-28 07:08:11");
INSERT INTO heads VALUES("23","Est. Shipment Clrs. Expenses","Expense","Cost of Goods","24500","24500","2019-05-28 08:17:28","2019-05-28 08:17:28");
INSERT INTO heads VALUES("24","Air Freight Inward","Expense","Cost of Goods","18600","18600","2019-05-28 08:18:00","2019-05-28 08:18:00");
INSERT INTO heads VALUES("25","Import Duties & A. Duties","Expense","Cost of Goods","235840","235840","2019-05-28 08:18:15","2019-05-28 08:18:15");
INSERT INTO heads VALUES("26","Import PRA CESS Duty","Expense","Cost of Goods","235874","235874","2019-05-28 08:18:28","2019-05-28 08:18:28");
INSERT INTO heads VALUES("27","Import GST & A. GST","Expense","Cost of Goods","6218874","6218874","2019-05-28 08:18:45","2019-05-28 08:18:45");
INSERT INTO heads VALUES("28","Import Customs Clearance Misc. Exp","Expense","Cost of Goods","8648422","8648422","2019-05-28 08:19:02","2019-05-28 08:19:02");
INSERT INTO heads VALUES("29","Local Freight outward","Expense","Cost of Goods","52485","52485","2019-05-28 08:19:19","2019-05-28 08:19:19");
INSERT INTO heads VALUES("30","Staff Salaries","Expense","Administrative Expenses","5842100","5842100","2019-05-31 08:44:27","2019-05-31 08:44:27");
INSERT INTO heads VALUES("31","Office Rent","Expense","Administrative Expenses","250000","250000","2019-05-31 08:44:47","2019-05-31 08:44:47");
INSERT INTO heads VALUES("32","MAN Petrol","Expense","Administrative Expenses","52000","52000","2019-05-31 08:45:00","2019-05-31 08:45:00");
INSERT INTO heads VALUES("33","KS Communication","Expense","Marketing Expenses","254000","254000","2019-05-31 08:54:05","2019-05-31 08:54:05");
INSERT INTO heads VALUES("34","MAN Communication Exp","Expense","Marketing Expenses","32000","32000","2019-05-31 08:54:20","2019-05-31 08:54:20");
INSERT INTO heads VALUES("35","Bank Charges","Expense","Financial Expenses","650000","650000","2019-05-31 09:06:34","2019-05-31 09:06:34");
INSERT INTO heads VALUES("36","Tax deducted by Bank","Expense","Financial Expenses","32000","32000","2019-05-31 09:06:52","2019-05-31 09:06:52");



CREATE TABLE `journalvouchers` (
  `jv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `jv_no` varchar(100) NOT NULL,
  `jv_acc_ID` varchar(100) NOT NULL,
  `jv_acc_name` varchar(100) NOT NULL,
  `jv_acc_status` varchar(100) NOT NULL,
  `jv_description` varchar(200) NOT NULL,
  `jv_amount` varchar(150) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`jv_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO journalvouchers VALUES("1","JV-00000","1","CIH-FARAN","Debit","","30000","18-Apr-2019 ","18-Apr-2019 ");
INSERT INTO journalvouchers VALUES("2","JV-00000","9","SILVER LINKS","Credit","","30000","18-Apr-2019 ","18-Apr-2019");
INSERT INTO journalvouchers VALUES("3","JV-00001","2","CIH-STAR","Credit","","10000","23-Apr-2019 11:33:08 AM","23-Apr-2019 11:33:08 AM");
INSERT INTO journalvouchers VALUES("4","JV-00001","1","CIH-FARAN","Credit","","10000","23-Apr-2019 11:33:08 AM","23-Apr-2019 11:33:08 AM");
INSERT INTO journalvouchers VALUES("5","JV-00001","1","Dwyer","Debit","","20000","23-Apr-2019 11:33:08 AM","23-Apr-2019 11:33:08 AM");
INSERT INTO journalvouchers VALUES("6","JV-00002","1","CIH-FARAN","Credit","","9000","26-Apr-2019 2:45:20 PM","26-Apr-2019 2:45:20 PM");
INSERT INTO journalvouchers VALUES("7","JV-00002","0184-4056","Waleed Ahmad","Debit","","9000","26-Apr-2019 2:45:20 PM","26-Apr-2019 2:45:20 PM");
INSERT INTO journalvouchers VALUES("8","JV-00003","1","CIH-FARAN","Credit","","10000","30-Apr-2019 11:18:34 AM","30-Apr-2019 11:18:34 AM");
INSERT INTO journalvouchers VALUES("9","JV-00003","0184-4056","Waleed Ahmad","Debit","","10000","30-Apr-2019 11:18:34 AM","30-Apr-2019 11:18:34 AM");
INSERT INTO journalvouchers VALUES("10","JV-00004","1","CIH-FARAN","Credit","Test Payable","2000","03-May-2019 10:46:21 AM","03-May-2019 10:46:21 AM");
INSERT INTO journalvouchers VALUES("11","JV-00004","2","CIH-STAR","Debit","Test Receivable","2000","03-May-2019 10:46:21 AM","03-May-2019 10:46:21 AM");
INSERT INTO journalvouchers VALUES("12","JV-00005","0184-4051","Faran Waseem","Credit","Test Payable","4000","03-May-2019 10:46:59 AM","03-May-2019 10:46:59 AM");
INSERT INTO journalvouchers VALUES("13","JV-00005","0184-4056","Waleed Ahmad","Debit","Test Receivable","4000","03-May-2019 10:46:59 AM","03-May-2019 10:46:59 AM");
INSERT INTO journalvouchers VALUES("14","JV-00006","9","SILVER LINKS","Credit","Test Payable","1000","03-May-2019 10:47:43 AM","03-May-2019 10:47:43 AM");
INSERT INTO journalvouchers VALUES("15","JV-00006","10","SAHARA CHEMICALS","Debit","Test Receivable","1000","03-May-2019 10:47:43 AM","03-May-2019 10:47:43 AM");
INSERT INTO journalvouchers VALUES("16","JV-00007","3","Kinda","Debit","Test Receivable","8000","03-May-2019 10:48:22 AM","03-May-2019 10:48:22 AM");
INSERT INTO journalvouchers VALUES("17","JV-00007","3","Kinda","Debit","Test Receivable","8000","03-May-2019 10:48:22 AM","03-May-2019 10:48:22 AM");
INSERT INTO journalvouchers VALUES("18","JV-00007","1","Dwyer","Credit","Test payable","8000","03-May-2019 10:48:22 AM","03-May-2019 10:48:22 AM");
INSERT INTO journalvouchers VALUES("19","JV-00008","1","CIH-FARAN","Credit","Test Payable","8000","03-May-2019 10:49:41 AM","03-May-2019 10:49:41 AM");
INSERT INTO journalvouchers VALUES("20","JV-00008","1","Dwyer","Debit","Test Receivable","8000","03-May-2019 10:49:41 AM","03-May-2019 10:49:41 AM");
INSERT INTO journalvouchers VALUES("21","JV-00009","2","Azbil","Debit","Test Receivable","8000","03-May-2019 10:52:52 AM","03-May-2019 10:52:52 AM");
INSERT INTO journalvouchers VALUES("22","JV-00009","1","Dwyer","Credit","Test payable","8000","03-May-2019 10:52:52 AM","03-May-2019 10:52:52 AM");
INSERT INTO journalvouchers VALUES("23","JV-00010","1","Accounts Payable","Credit","Test Payable","810","03-May-2019 10:53:23 AM","03-May-2019 10:53:23 AM");
INSERT INTO journalvouchers VALUES("24","JV-00010","9","Toyota Corolla GLI","Debit","Test Receivable","810","03-May-2019 10:53:23 AM","03-May-2019 10:53:23 AM");
INSERT INTO journalvouchers VALUES("25","JV-00011","1","CIH-FARAN","Credit","Test Payable","2500","03-May-2019 10:54:01 AM","03-May-2019 10:54:01 AM");
INSERT INTO journalvouchers VALUES("26","JV-00011","2","CIH-STAR","Debit","Test Receivable","2500","03-May-2019 10:54:01 AM","03-May-2019 10:54:01 AM");
INSERT INTO journalvouchers VALUES("27","JV-00012","1","CIH-FARAN","Credit","Test Payable","500","03-May-2019 11:09:32 AM","03-May-2019 11:09:32 AM");
INSERT INTO journalvouchers VALUES("28","JV-00012","11","Staff Refreshment","Debit","Test Receivable","500","03-May-2019 11:09:32 AM","03-May-2019 11:09:32 AM");



CREATE TABLE `lotnumber` (
  `lot_ID` int(11) NOT NULL AUTO_INCREMENT,
  `lot_number` varchar(200) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`lot_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO lotnumber VALUES("1","LT-00000","06-Feb-2019","06-Feb-2019");
INSERT INTO lotnumber VALUES("2","LT-00001","16-Feb-2019","16-Feb-2019");
INSERT INTO lotnumber VALUES("3","LT-00002","22-Feb-2019","22-Feb-2019");
INSERT INTO lotnumber VALUES("4","LT-00003","27-Mar-2019","27-Mar-2019");
INSERT INTO lotnumber VALUES("5","LT-00004","22-Mar-2019","22-Mar-2019");
INSERT INTO lotnumber VALUES("6","LT-00005","05-Apr-2019","05-Apr-2019");
INSERT INTO lotnumber VALUES("7","LT-00006","11-Apr-2019","11-Apr-2019");
INSERT INTO lotnumber VALUES("8","LT-00007","05-Apr-2019","05-Apr-2019");
INSERT INTO lotnumber VALUES("9","LT-00008","06-Apr-2019","06-Apr-2019");
INSERT INTO lotnumber VALUES("10","LT-00009","06-Apr-2019","06-Apr-2019");
INSERT INTO lotnumber VALUES("11","LT-00010","06-Apr-2019","06-Apr-2019");
INSERT INTO lotnumber VALUES("12","LT-00011","11-Apr-2019","11-Apr-2019");
INSERT INTO lotnumber VALUES("13","LT-00012","31-May-2019","31-May-2019");



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `mrreports` (
  `mr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `mr_number` varchar(200) NOT NULL,
  `mr_name` varchar(100) NOT NULL,
  `mr_area` varchar(200) NOT NULL,
  `mr_title` varchar(200) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `mr_supplier` varchar(100) NOT NULL,
  `mr_item` varchar(100) NOT NULL,
  `mr_size` varchar(100) NOT NULL,
  `mr_specs` varchar(150) NOT NULL,
  `mr_description` varchar(200) NOT NULL,
  `mr_quantity` varchar(100) NOT NULL,
  `mr_received_by` varchar(100) NOT NULL,
  `lot_number` varchar(200) NOT NULL,
  `mr_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`mr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO mrreports VALUES("7","PR-00000","Kashif Shamsuddin","-","Request for Instruments","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","60","Kashif Shamsuddin","LT-00004","1","22-Mar-2019","22-Mar-2019");
INSERT INTO mrreports VALUES("8","PR-00001","Kashif Shamsuddin","-","Request for Instruments","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","150","Kashif Shamsuddin","LT-00005","1","05-Apr-2019","05-Apr-2019");
INSERT INTO mrreports VALUES("9","PR-00002","Kashif Shamsuddin","-","Request for Instruments","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","200","Kashif Shamsuddin","LT-00006","1","11-Apr-2019","11-Apr-2019");
INSERT INTO mrreports VALUES("10","PR-00003","Kashif Shamsuddin","-","Request for Instruments","xyz","2","Azbil","Azbil","Controller","NX","NX 70","test description","100","Kashif Shamsuddin","LT-00007","0","05-Apr-2019","05-Apr-2019");
INSERT INTO mrreports VALUES("11","PR-00004","Kashif Shamsuddin","-","Request for Instruments","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","Kashif Shamsuddin","LT-00008","1","06-Apr-2019","06-Apr-2019");
INSERT INTO mrreports VALUES("12","PR-00005","Kashif Shamsuddin","-","Request for Instruments","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","100","Kashif Shamsuddin","LT-00009","1","06-Apr-2019","06-Apr-2019");
INSERT INTO mrreports VALUES("13","PR-00006","Kashif Shamsuddin","-","Request for Instruments","xyz","2","Azbil","Azbil","Controller","NX","NX 70","--","150","Kashif Shamsuddin","LT-00010","1","06-Apr-2019","06-Apr-2019");
INSERT INTO mrreports VALUES("14","PR-00008","Kashif Shamsuddin","-","Request for Instruments","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description","100","Kashif Shamsuddin","LT-00011","1","11-Apr-2019","11-Apr-2019");
INSERT INTO mrreports VALUES("15","PR-00008","Kashif Shamsuddin","-","Request for Instruments","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","Kashif Shamsuddin","LT-00011","1","11-Apr-2019","11-Apr-2019");
INSERT INTO mrreports VALUES("16","PR-00011","Kashif Shamsuddin","-","test title","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","50","Kashif Shamsuddin","LT-00012","1","31-May-2019","31-May-2019");
INSERT INTO mrreports VALUES("17","PR-00011","Kashif Shamsuddin","-","test title","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description 2","100","Kashif Shamsuddin","LT-00012","1","31-May-2019","31-May-2019");
INSERT INTO mrreports VALUES("18","PR-00011","Kashif Shamsuddin","-","test title","Mr Tom Henry","1","Dwyer","Kinda","VFD","VX-100","test specs","test description 3","150","Kashif Shamsuddin","LT-00012","1","31-May-2019","31-May-2019");
INSERT INTO mrreports VALUES("19","PR-00011","Kashif Shamsuddin","-","test title","Mr Tom Henry","1","Dwyer","China","Office Chair","-","Comfortable Chair for long sittings","test description 4","200","Kashif Shamsuddin","LT-00012","1","31-May-2019","31-May-2019");



CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO password_resets VALUES("faranwaseem10@hotmail.com","$2y$10$P0BBlkdYEVrmh/D5Bnz2BuBjnBhbbJ6tqtigEsLc7wfZtoYZgQbG.","2019-03-13 10:16:24");
INSERT INTO password_resets VALUES("waleed.ahmad@starautomation.net","$2y$10$yWzorYrYLAxDc1MB/.2qMuHGyA/9N59.aUwWiuBSnKW.PCrOMDgeO","2019-03-19 06:55:55");
INSERT INTO password_resets VALUES("starautomation83n@gmail.com","$2y$10$DsQ7TuZz6rqAx5nbCxizheg8e0CnEF4NJqCcGQAr2uHcKAQvMnlQ6","2019-03-19 10:05:50");
INSERT INTO password_resets VALUES("starautomation84n@gmail.com","$2y$10$uFR6vERgfxY5L/8dKUWfhuZRWSAvSpoFQ4fCfd9uchOCHE.VFsccW","2019-03-19 11:07:36");



CREATE TABLE `porders` (
  `po_ID` int(11) NOT NULL AUTO_INCREMENT,
  `po_number` varchar(150) NOT NULL,
  `po_name` varchar(100) NOT NULL,
  `po_title` varchar(150) NOT NULL,
  `po_area` varchar(150) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `po_supplier` varchar(100) NOT NULL,
  `po_item` varchar(100) NOT NULL,
  `po_size` varchar(100) NOT NULL,
  `po_specs` varchar(150) NOT NULL,
  `po_description` varchar(200) NOT NULL,
  `po_quantity` varchar(100) NOT NULL,
  `po_unitprice` varchar(100) NOT NULL,
  `po_unitpricepkr` varchar(150) NOT NULL,
  `po_type` varchar(50) NOT NULL,
  `po_itype` varchar(50) NOT NULL,
  `po_iamount` varchar(100) NOT NULL,
  `po_currency` varchar(50) NOT NULL,
  `po_conrate` varchar(50) NOT NULL,
  `po_gstp` varchar(100) NOT NULL,
  `po_gst` varchar(100) NOT NULL,
  `po_totalprice` varchar(100) NOT NULL,
  `po_grandtotal` varchar(200) NOT NULL,
  `po_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`po_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO porders VALUES("14","PR-00000","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","60","800","","imports","EXW","500","USD","139.5","0","0","48500","6765750.00","1","22-Mar-2019","22-Mar-2019");
INSERT INTO porders VALUES("15","PR-00001","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","150","225","32625","imports","EXW","300","USD","145","0","0","34050","4937250.00","1","04-Apr-2019","04-Apr-2019");
INSERT INTO porders VALUES("16","PR-00002","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","200","5000","5000","local","0","0","0","0","18","180000.00","1000000","1180000","1","04-Apr-2019","04-Apr-2019");
INSERT INTO porders VALUES("17","PR-00003","Kashif Shamsuddin","Request for Instruments","-","xyz","2","Azbil","Azbil","Controller","NX","NX 70","test description","100","200","29000","imports","EXW","300","USD","145","0","0","20300","2943500.00","1","04-Apr-2019","04-Apr-2019");
INSERT INTO porders VALUES("18","PR-00004","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","8000","8000","local","0","0","0","0","17","136000.00","800000","936000","1","05-Apr-2019","05-Apr-2019");
INSERT INTO porders VALUES("19","PR-00005","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","100","10","1400","imports","EXW","500","USD","140","0","0","1500","210000.00","1","05-Apr-2019","05-Apr-2019");
INSERT INTO porders VALUES("20","PR-00006","Kashif Shamsuddin","Request for Instruments","-","xyz","2","Azbil","Azbil","Controller","NX","NX 70","--","150","8000","8000","local","0","0","0","0","17","204000.00","1200000","1404000","1","05-Apr-2019","05-Apr-2019");
INSERT INTO porders VALUES("21","PR-00007","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","50","7000","imports","FOB","500","USD","140","0","0","5400","756000.00","0","06-Apr-2019","06-Apr-2019");
INSERT INTO porders VALUES("22","PR-00007","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","-","80","30","4200","imports","FOB","500","USD","140","0","0","5400","756000.00","0","06-Apr-2019","06-Apr-2019");
INSERT INTO porders VALUES("23","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description","100","25","3500","imports","FOB","500","USD","140","0","0","3900","546000.00","1","10-Apr-2019 4:44:50 PM","10-Apr-2019 4:44:50 PM");
INSERT INTO porders VALUES("24","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","18","2520","imports","FOB","500","USD","140","0","0","3900","546000.00","1","10-Apr-2019 4:44:50 PM","10-Apr-2019 4:44:50 PM");
INSERT INTO porders VALUES("25","PR-00010","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","8000","8000","local","0","0","0","0","17","136000.00","800000","936000","1","23-Apr-2019 11:26:22 AM","23-Apr-2019 11:26:22 AM");
INSERT INTO porders VALUES("26","PR-00009","Kashif Shamsuddin","Request for Chairs","-","Mr Tom Henry","1","Dwyer","China","Office Chair","-","Comfortable Chair for long sittings","-","2","5000","755000","imports","EXW","2000","USD","151","0","0","12000","1812000.00","0","30-May-2019 1:55:08 PM","30-May-2019 1:55:08 PM");
INSERT INTO porders VALUES("27","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","50","3000","450000","imports","EXW","2500","USD","150","0","0","2002500","300375000.00","1","30-May-2019 1:58:01 PM","30-May-2019 1:58:01 PM");
INSERT INTO porders VALUES("28","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description 2","100","3500","525000","imports","EXW","2500","USD","150","0","0","2002500","300375000.00","1","30-May-2019 1:58:01 PM","30-May-2019 1:58:01 PM");
INSERT INTO porders VALUES("29","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Kinda","VFD","VX-100","test specs","test description 3","150","4000","600000","imports","EXW","2500","USD","150","0","0","2002500","300375000.00","1","30-May-2019 1:58:01 PM","30-May-2019 1:58:01 PM");
INSERT INTO porders VALUES("30","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","China","Office Chair","-","Comfortable Chair for long sittings","test description 4","200","4500","675000","imports","EXW","2500","USD","150","0","0","2002500","300375000.00","1","30-May-2019 1:58:01 PM","30-May-2019 1:58:01 PM");



CREATE TABLE `prequisitions` (
  `pr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pr_number` varchar(200) NOT NULL,
  `pr_title` varchar(150) NOT NULL,
  `pr_name` varchar(100) NOT NULL,
  `pr_area` varchar(100) NOT NULL,
  `s_company` varchar(100) NOT NULL,
  `pr_item` varchar(100) NOT NULL,
  `pr_size` varchar(100) NOT NULL,
  `pr_specs` varchar(150) NOT NULL,
  `pr_description` varchar(200) NOT NULL,
  `pr_quantity` varchar(100) NOT NULL,
  `pr_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`pr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

INSERT INTO prequisitions VALUES("23","PR-00000","Request for Instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","60","2","22-Mar-2019","22-Mar-2019");
INSERT INTO prequisitions VALUES("24","PR-00001","Request for Instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","150","2","04-Apr-2019","04-Apr-2019");
INSERT INTO prequisitions VALUES("25","PR-00002","Request for Instruments","Kashif Shamsuddin","-","Kinda","VFD","VX-100","test specs","test description","200","2","04-Apr-2019","04-Apr-2019");
INSERT INTO prequisitions VALUES("26","PR-00003","Request for Instruments","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","test description","100","2","04-Apr-2019","04-Apr-2019");
INSERT INTO prequisitions VALUES("27","PR-00004","Request for Instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","2","05-Apr-2019","05-Apr-2019");
INSERT INTO prequisitions VALUES("28","PR-00005","Request for Instruments","Kashif Shamsuddin","-","Kinda","VFD","VX-100","test specs","test description","100","2","05-Apr-2019","05-Apr-2019");
INSERT INTO prequisitions VALUES("29","PR-00006","Request for Instruments","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","--","150","2","05-Apr-2019","05-Apr-2019");
INSERT INTO prequisitions VALUES("30","PR-00007","Request for Instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","2","06-Apr-2019","06-Apr-2019");
INSERT INTO prequisitions VALUES("31","PR-00007","Request for Instruments","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","-","80","2","06-Apr-2019","06-Apr-2019");
INSERT INTO prequisitions VALUES("32","PR-00008","Request for Instruments","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","test description","100","2","10-Apr-2019 4:43:52 PM","10-Apr-2019 4:43:52 PM");
INSERT INTO prequisitions VALUES("33","PR-00008","Request for Instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","2","10-Apr-2019 4:43:52 PM","10-Apr-2019 4:43:52 PM");
INSERT INTO prequisitions VALUES("34","PR-00009","Request for Chairs","Kashif Shamsuddin","-","China","Office Chair","-","Comfortable Chair for long sittings","-","2","2","15-Apr-2019 12:45:17 PM","15-Apr-2019 12:45:17 PM");
INSERT INTO prequisitions VALUES("35","PR-00010","Request for Instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","2","23-Apr-2019 11:25:05 AM","23-Apr-2019 11:25:05 AM");
INSERT INTO prequisitions VALUES("36","PR-00011","test title","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","50","2","30-May-2019 1:57:15 PM","30-May-2019 1:57:15 PM");
INSERT INTO prequisitions VALUES("37","PR-00011","test title","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","test description 2","100","2","30-May-2019 1:57:15 PM","30-May-2019 1:57:15 PM");
INSERT INTO prequisitions VALUES("38","PR-00011","test title","Kashif Shamsuddin","-","Kinda","VFD","VX-100","test specs","test description 3","150","2","30-May-2019 1:57:15 PM","30-May-2019 1:57:15 PM");
INSERT INTO prequisitions VALUES("39","PR-00011","test title","Kashif Shamsuddin","-","China","Office Chair","-","Comfortable Chair for long sittings","test description 4","200","2","30-May-2019 1:57:15 PM","30-May-2019 1:57:15 PM");



CREATE TABLE `products` (
  `p_ID` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(150) NOT NULL,
  `p_size` varchar(150) NOT NULL,
  `p_specs` varchar(200) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`p_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO products VALUES("1","Magnehalic Gauge","Mark |||","60 Pascal","1","Dwyer","04-Feb-2019 12:38 PM","15-Mar-2019 9:43 AM");
INSERT INTO products VALUES("2","Controller","NX","NX 70","2","Azbil","14-Feb-2019 2:22 PM","14-Feb-2019 2:22 PM");
INSERT INTO products VALUES("3","VFD","VX-100","test specs","3","Kinda","14-Feb-2019 2:22 PM","14-Feb-2019 2:22 PM");
INSERT INTO products VALUES("4","Office Chair","-","Comfortable Chair for long sittings","5","China","15-Apr-2019 12:44 PM","15-Apr-2019 12:44 PM");



CREATE TABLE `roles` (
  `r_ID` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`r_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO roles VALUES("1","1","Waleed Ahmad","starautomation83n@gmail.com","Admin","2019-01-31 07:39:36","2019-01-31 07:39:36");
INSERT INTO roles VALUES("2","2","Naveed ","operator@starautomation.net","Operator","2019-01-31 07:39:36","2019-01-31 07:39:36");



CREATE TABLE `sales` (
  `sl_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sl_number` varchar(100) NOT NULL,
  `fr_ID` varchar(100) NOT NULL,
  `fr_name` varchar(100) NOT NULL,
  `fr_cnic` varchar(150) NOT NULL,
  `lot_number` varchar(150) NOT NULL,
  `sl_title` varchar(150) NOT NULL,
  `sl_name` varchar(100) NOT NULL,
  `sl_area` varchar(150) NOT NULL,
  `sl_i_ID` varchar(100) NOT NULL,
  `sl_item` varchar(100) NOT NULL,
  `sl_size` varchar(100) NOT NULL,
  `sl_quantity` varchar(100) NOT NULL,
  `sl_saleprice` varchar(100) NOT NULL,
  `sl_total` varchar(100) NOT NULL,
  `sl_totalprice` varchar(100) NOT NULL,
  `sl_grandtotal` varchar(150) NOT NULL,
  `sl_type` varchar(50) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`sl_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

INSERT INTO sales VALUES("1","SR-00000","9","SILVER LINKS","2251963-7","LT-00000","Sales to Shazo Zaka","Kashif Shamsuddin","-","2","MAGNEHELIC DP GAUGE","2300-120PA","5","15000","75000","87750.00","105300.00","GST","04-Apr-2019","04-Apr-2019");
INSERT INTO sales VALUES("2","SR-00000","9","SILVER LINKS","2251963-7","LT-00003","Sales to Shazo Zaka","Kashif Shamsuddin","-","9","MAGNEHELIC DP GAUGE","2300-120PA","1","15000","15000","17550.00","105300.00","GST","04-Apr-2019","04-Apr-2019");
INSERT INTO sales VALUES("5","SR-00001","1","Bharmal International","Husnain","LT-00003","Sales to Bharmal International","Kashif Shamsuddin","-","7","MAGNEHELIC DP GAUGE","2000-60PA","20","9800","196000","196000.00","490000.00","GST","04-Apr-2019","04-Apr-2019");
INSERT INTO sales VALUES("6","SR-00001","1","Bharmal International","Husnain","LT-00000","Sales to Bharmal International","Kashif Shamsuddin","-","12","MAGNEHELIC DP GAUGE","2300-60PA","30","9800","294000","294000.00","490000.00","GST","04-Apr-2019","04-Apr-2019");
INSERT INTO sales VALUES("7","SR-00002","1","Bharmal International","Husnain","LT-00000","Sales to Bharmal International","Kashif Shamsuddin","-","12","MAGNEHELIC DP GAUGE","2300-60PA","24","9800","235200","235200.00","431200.00","GST","05-Apr-2019","05-Apr-2019");
INSERT INTO sales VALUES("8","SR-00002","1","Bharmal International","Husnain","LT-00003","Sales to Bharmal International","Kashif Shamsuddin","-","8","MAGNEHELIC DP GAUGE","2300-60PA","20","9800","196000","196000.00","431200.00","GST","05-Apr-2019","05-Apr-2019");
INSERT INTO sales VALUES("9","SR-00003","35","Ferozesons Laboratories Ltd.","0657289-8","LT-00004","sales to ferozsons","Kashif Shamsuddin","-","13","Plastic  Static Pressure Tip","A-480","300","400","120000","140400.00","140400.00","GST","05-Apr-2019","05-Apr-2019");
INSERT INTO sales VALUES("10","SR-00004","5","ATLAS HONDA LIMITED.","0801063-3","LT-00000","Sales of Limit Switches to AHL","Kashif Shamsuddin","-","77","LIMIT SWITCH","1LS3-J","12","6950","83400","97578.00","97578.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("16","SR-00005","1","Bharmal International","Husnain","LT-00000","Sales to Bharmal International","Kashif Shamsuddin","-","81","PRESSURE TRANSMITTER","628-75-GH-P9-E4-S1","2","10500","21000","21000.00","105000.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("17","SR-00005","1","Bharmal International","Husnain","LT-00004","Sales to Bharmal International","Kashif Shamsuddin","-","18","PRESSURE TRANSMITTER","628-92-GH-P9-E4-S1","2","10500","21000","21000.00","105000.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("18","SR-00005","1","Bharmal International","Husnain","LT-00004","Sales to Bharmal International","Kashif Shamsuddin","-","17","PRESSURE TRANSMITTER","628-93-GH-P9-E4-S1","2","10500","21000","21000.00","105000.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("19","SR-00005","1","Bharmal International","Husnain","LT-00000","Sales to Bharmal International","Kashif Shamsuddin","-","79","PRESSURE TRANSMITTER","628-91-GH-P9-E4-S1","2","10500","21000","21000.00","105000.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("20","SR-00005","1","Bharmal International","Husnain","LT-00000","Sales to Bharmal International","Kashif Shamsuddin","-","80","PRESSURE TRANSMITTER","628-90-GH-P9-E4-S1","2","10500","21000","21000.00","105000.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("21","SR-00006","10","FIRST TREET MANUFACTURING MUDARBA","2551646-9","LT-00005","Sales to Treet Battery","Kashif Shamsuddin","-","104","RTD","PT100","10","5600","56000","65520.00","65520.00","GST","09-Apr-2019","09-Apr-2019");
INSERT INTO sales VALUES("22","SR-00007","42","SRC Private Limited","0288106-3","LT-00000","Sales to SRC Private limited","Kashif Shamsuddin","-","81","PRESSURE TRANSMITTER","628-75-GH-P9-E4-S1","1","15000","15000","17550.00","17550.00","GST","10-Apr-2019 5:32:14 PM","10-Apr-2019 5:32:14 PM");
INSERT INTO sales VALUES("23","SR-00008","43","Sigma Engineering","Sigma","LT-00004","sales to Sigma Engineer","Kashif Shamsuddin","-","17","PRESSURE TRANSMITTER","628-93-GH-P9-E4-S1","1","18500","18500","18500.00","18500.00","GST","10-Apr-2019 7:20:11 PM","10-Apr-2019 7:20:11 PM");
INSERT INTO sales VALUES("24","SR-00009","2","World Star","Hafiz","LT-00000","sales of magnehellic gauges to world star","Kashif Shamsuddin","-","38","MAGNEHELIC DP GAUGE","2004","4","10800","43200","43200.00","43200.00","GST","11-Apr-2019 6:15:03 PM","11-Apr-2019 6:15:03 PM");
INSERT INTO sales VALUES("25","SR-00010","2","World Star","Hafiz","LT-00000","sales of magnehellic gauges to world star","Kashif Shamsuddin","-","38","MAGNEHELIC DP GAUGE","2004","11","10800","118800","118800.00","118800.00","GST","11-Apr-2019 6:16:46 PM","11-Apr-2019 6:16:46 PM");
INSERT INTO sales VALUES("26","SR-00011","22","WATER REGIME (Pvt) Ltd.","1736769-7","LT-00004","Sales of Transmitter to Water REgime","Kashif Shamsuddin","-","17","PRESSURE TRANSMITTER","628-93-GH-P9-E4-S1","1","18000","18000","21060.00","21060.00","GST","19-Apr-2019 3:14:02 PM","19-Apr-2019 3:14:02 PM");
INSERT INTO sales VALUES("27","SR-00012","4","STAR CORPORATION","4243479-3","LT-00000","Sales to Star Corporation - Pressure Gauges","Kashif Shamsuddin","-","86","PRESSURE GAUGE","Dial 4'', Bottom Conn.","6","6500","39000","39000.00","39000.00","GST","19-Apr-2019 3:18:59 PM","19-Apr-2019 3:18:59 PM");
INSERT INTO sales VALUES("28","SR-00013","47","Imran Enterprise","Imran","LT-00003","Sales of Magnehellic Gauges to Imran Enterprise","Kashif Shamsuddin","-","7","MAGNEHELIC DP GAUGE","2000-60PA","6","10800","64800","64800.00","64800.00","GST","24-Apr-2019 6:27:14 PM","24-Apr-2019 6:27:14 PM");
INSERT INTO sales VALUES("29","SR-00014","48","Kohinoor Mills","06581846","LT-00006","sales of PH Controller with accessories to Kohinoor","Kashif Shamsuddin","-","151","pH/ORP Controller","PH7635","1","100000","100000","117000.00","193050.00","GST","25-Apr-2019 1:29:27 PM","25-Apr-2019 1:29:27 PM");
INSERT INTO sales VALUES("30","SR-00014","48","Kohinoor Mills","06581846","LT-00006","sales of PH Controller with accessories to Kohinoor","Kashif Shamsuddin","-","152","PH Electrode","SZ195.2","1","45000","45000","52650.00","193050.00","GST","25-Apr-2019 1:29:27 PM","25-Apr-2019 1:29:27 PM");
INSERT INTO sales VALUES("31","SR-00014","48","Kohinoor Mills","06581846","LT-00006","sales of PH Controller with accessories to Kohinoor","Kashif Shamsuddin","-","153","Sensor Holder","SZ7108","1","20000","20000","23400.00","193050.00","GST","25-Apr-2019 1:29:27 PM","25-Apr-2019 1:29:27 PM");
INSERT INTO sales VALUES("32","SR-00015","4","STAR CORPORATION","4243479-3","LT-00000","FS-2 sales to Star Corporation","Kashif Shamsuddin","-","59","FLOW SWITCH","FS-2","7","13000","91000","91000.00","91000.00","GST","02-May-2019 2:45:10 PM","02-May-2019 2:45:10 PM");
INSERT INTO sales VALUES("33","SR-00016","23","ENGRO FERTILIZERS Ltd.","3378860-0","LT-00007","sales to Engro","Kashif Shamsuddin","-","154","Remote Seal Transmitter","GTX37R-AB999FA9905-AXXAHA6-R1T1W1","1","2385000","2385000","2790450.00","2790450.00","GST","02-May-2019 5:10:04 PM","02-May-2019 5:10:04 PM");
INSERT INTO sales VALUES("34","SR-00017","51","Amir Ghouri","Amir","LT-00000","sales to Amir Ghouri","Kashif Shamsuddin","-","82","Magnehelic DP Transmitter","DM-2007-LCD","2","29000","58000","58000.00","58000.00","GST","11-May-2019 12:17:35 PM","11-May-2019 12:17:35 PM");
INSERT INTO sales VALUES("35","SR-00018","52","Labsonic","Lab","LT-00008","sales of manometer to labsonic","Kashif Shamsuddin","-","155","MANOMETER","MARK II 25","30","4300","129000","129000.00","129000.00","GST","13-May-2019 3:53:31 PM","13-May-2019 3:53:31 PM");
INSERT INTO sales VALUES("36","SR-00019","4","STAR CORPORATION","4243479-3","LT-00000","sales of Gauges to Star Corporation","Kashif Shamsuddin","-","85","PRESSURE GAUGE","Dial 4'', Bottom Conn.","12","6500","78000","78000.00","78000.00","GST","13-May-2019 4:34:48 PM","13-May-2019 4:34:48 PM");
INSERT INTO sales VALUES("37","SR-00020","53","Kamal Scientific","Kamal","LT-00008","sales of manometers to Kamal Scientifics","Kashif Shamsuddin","-","155","MANOMETER","MARK II 25","42","4300","180600","180600.00","430000.00","GST","16-May-2019 10:12:00 AM","16-May-2019 10:12:00 AM");
INSERT INTO sales VALUES("38","SR-00020","53","Kamal Scientific","Kamal","LT-00009","sales of manometers to Kamal Scientifics","Kashif Shamsuddin","-","158","MANOMETER","MARK II 25","58","4300","249400","249400.00","430000.00","GST","16-May-2019 10:12:00 AM","16-May-2019 10:12:00 AM");
INSERT INTO sales VALUES("39","SR-00022","51","Amir Ghouri","Amir","LT-00000","sales to Amir Ghouri","Kashif Shamsuddin","-","117","DP SWITCH","ADPS-08-2-N","2","5500","11000","11000.00","11000.00","GST","21-May-2019 2:34:39 PM","21-May-2019 2:34:39 PM");
INSERT INTO sales VALUES("40","SR-00023","45","Adv Customers","ADv","LT-00000","sales of Humidity Sensors","Kashif Shamsuddin","-","109","HUMIDITY/TEMP. TRANSMITTER","RHP-2N44-LCD","3","27000","81000","81000.00","81000.00","GST","21-May-2019 2:38:02 PM","21-May-2019 2:38:02 PM");
INSERT INTO sales VALUES("41","SR-00024","24","Nabi Qasim Industries (Pvt) Ltd.","0711289-7","LT-00009","sales of manometers and magnehellic gauges to Nabi Qasim","Kashif Shamsuddin","-","158","MANOMETER","MARK II 25","6","6500","39000","45630.00","221130.00","GST","23-May-2019 2:42:21 PM","23-May-2019 2:42:21 PM");
INSERT INTO sales VALUES("42","SR-00024","24","Nabi Qasim Industries (Pvt) Ltd.","0711289-7","LT-00003","sales of manometers and magnehellic gauges to Nabi Qasim","Kashif Shamsuddin","-","7","MAGNEHELIC DP GAUGE","2000-60PA","4","12500","50000","58500.00","221130.00","GST","23-May-2019 2:42:21 PM","23-May-2019 2:42:21 PM");
INSERT INTO sales VALUES("43","SR-00024","24","Nabi Qasim Industries (Pvt) Ltd.","0711289-7","LT-00004","sales of manometers and magnehellic gauges to Nabi Qasim","Kashif Shamsuddin","-","15","MAGNEHELIC DP GAUGE","2000-60PA","8","12500","100000","117000.00","221130.00","GST","23-May-2019 2:42:21 PM","23-May-2019 2:42:21 PM");
INSERT INTO sales VALUES("44","SR-00021","54","HEI - HRL JV","7112662-7","LT-00000","sales of Temp Transmitter","Kashif Shamsuddin","-","71","PT100 Transmitter","SEM206P","2","14500","29000","33930.00","33930.00","GST","23-May-2019 2:52:22 PM","23-May-2019 2:52:22 PM");
INSERT INTO sales VALUES("45","SR-00025","55","Fair Tech","Fair","LT-00004","magnehellic gauges sales to Fairtech 2000-60PA","Kashif Shamsuddin","-","15","MAGNEHELIC DP GAUGE","2000-60PA","20","10800","216000","216000.00","216000.00","GST","24-May-2019 12:46:34 PM","24-May-2019 12:46:34 PM");
INSERT INTO sales VALUES("46","SR-00026","45","Adv Customers","ADv","LT-00000","sales of RHP To Comet For NDC","Kashif Shamsuddin","-","109","HUMIDITY/TEMP. TRANSMITTER","RHP-2N44-LCD","1","27000","27000","27000.00","27000.00","GST","27-May-2019 12:13:47 PM","27-May-2019 12:13:47 PM");
INSERT INTO sales VALUES("47","SR-00027","1","Bharmal International","Husnain","LT-00000","magnehelic gauges for Bharmal","Kashif Shamsuddin","-","42","MAGNEHELIC DP GAUGE","2000-500PA","10","10000","100000","100000.00","532000.00","GST","15-Jun-2019 11:43:17 AM","15-Jun-2019 11:43:17 AM");
INSERT INTO sales VALUES("48","SR-00027","1","Bharmal International","Husnain","LT-00004","magnehelic gauges for Bharmal","Kashif Shamsuddin","-","15","MAGNEHELIC DP GAUGE","2000-60PA","10","10800","108000","108000.00","532000.00","GST","15-Jun-2019 11:43:17 AM","15-Jun-2019 11:43:17 AM");
INSERT INTO sales VALUES("49","SR-00027","1","Bharmal International","Husnain","LT-00008","magnehelic gauges for Bharmal","Kashif Shamsuddin","-","156","MAGNEHELIC DP GAUGE","2300-60PA","30","10800","324000","324000.00","532000.00","GST","15-Jun-2019 11:43:17 AM","15-Jun-2019 11:43:17 AM");
INSERT INTO sales VALUES("50","SR-00028","56","Midas","Midas","LT-00004","2000-60PA to Midas","Kashif Shamsuddin","-","15","MAGNEHELIC DP GAUGE","2000-60PA","20","10800","216000","216000.00","216000.00","GST","15-Jun-2019 11:50:10 AM","15-Jun-2019 11:50:10 AM");
INSERT INTO sales VALUES("51","SR-00029","57","Cap Engineering","Waqas","LT-00000","Sales to Cap engineering","Kashif Shamsuddin","-","49","MAGNEHELIC DP GAUGE","2060","2","15000","30000","30000.00","30000.00","GST","15-Jun-2019 11:54:37 AM","15-Jun-2019 11:54:37 AM");
INSERT INTO sales VALUES("52","SR-00031","58","Gadoon Textile","0000215-1","LT-00008","2000-1500PA to Gadoon Textile","Kashif Shamsuddin","-","157","Magnehellic Gauge","2000-1500PA","1","18000","18000","21060.00","21060.00","GST","18-Jun-2019 10:51:35 AM","18-Jun-2019 10:51:35 AM");
INSERT INTO sales VALUES("53","SR-00032","49","Bio Tech Energy (pvt) Limited","4283539-9","LT-00010","RTD PTFE to Bio tech","Kashif Shamsuddin","-","161","Thermowell with RTD","PTFE Thermowell with RTD","1","28500","28500","33345.00","33345.00","GST","18-Jun-2019 11:00:19 AM","18-Jun-2019 11:00:19 AM");
INSERT INTO sales VALUES("54","SR-00033","5","ATLAS HONDA LIMITED.","0801063-3","LT-00013","C36TR1UA1100 to AHL","Kashif Shamsuddin","-","165","Controller","C36TR1UA1100","1","89500","89500","104715.00","104715.00","GST","18-Jun-2019 11:04:39 AM","18-Jun-2019 11:04:39 AM");
INSERT INTO sales VALUES("55","SR-00030","7","SAHARA CHEMICALS (Pvt) Ltd.","4168476-1","LT-00013","sales of NX to Sahara Chemical","Kashif Shamsuddin","-","171","NX CONTROLLER","NX-CB2NN0400","1","95250","95250.00","111442.50","1345792.50","GST","18-Jun-2019 11:36:50 AM","18-Jun-2019 11:36:50 AM");
INSERT INTO sales VALUES("56","SR-00030","7","SAHARA CHEMICALS (Pvt) Ltd.","4168476-1","LT-00013","sales of NX to Sahara Chemical","Kashif Shamsuddin","-","170","NX Controller","NX-DX1NT1600","1","110000","110000.00","128700.00","1345792.50","GST","18-Jun-2019 11:36:50 AM","18-Jun-2019 11:36:50 AM");
INSERT INTO sales VALUES("57","SR-00030","7","SAHARA CHEMICALS (Pvt) Ltd.","4168476-1","LT-00013","sales of NX to Sahara Chemical","Kashif Shamsuddin","-","169","NX Controller","NX-D15NT4C30","3","135000","405000.00","473850.00","1345792.50","GST","18-Jun-2019 11:36:50 AM","18-Jun-2019 11:36:50 AM");
INSERT INTO sales VALUES("58","SR-00030","7","SAHARA CHEMICALS (Pvt) Ltd.","4168476-1","LT-00013","sales of NX to Sahara Chemical","Kashif Shamsuddin","-","168","NX CONTROLLER","NX-D15NT4C20","1","135000","135000.00","157950.00","1345792.50","GST","18-Jun-2019 11:36:50 AM","18-Jun-2019 11:36:50 AM");
INSERT INTO sales VALUES("59","SR-00030","7","SAHARA CHEMICALS (Pvt) Ltd.","4168476-1","LT-00013","sales of NX to Sahara Chemical","Kashif Shamsuddin","-","167","NX Controller","NX-D15NT4T20","3","135000","405000.00","473850.00","1345792.50","GST","18-Jun-2019 11:36:50 AM","18-Jun-2019 11:36:50 AM");
INSERT INTO sales VALUES("60","SR-00034","5","ATLAS HONDA LIMITED.","0801063-3","LT-00011","v-725 to AHL","Kashif Shamsuddin","-","162","Sesimic Sensor","V-725","5","42500","212500.00","248625.00","248625.00","GST","18-Jun-2019 12:48:11 PM","18-Jun-2019 12:48:11 PM");
INSERT INTO sales VALUES("61","SR-00035","5","ATLAS HONDA LIMITED.","0801063-3","LT-00012","8LS3-J to AHL","Kashif Shamsuddin","-","164","Limit Switch","8LS3-J","05","7250","36250.00","42412.50","42412.50","GST","18-Jun-2019 12:50:17 PM","18-Jun-2019 12:50:17 PM");
INSERT INTO sales VALUES("62","SR-00036","5","ATLAS HONDA LIMITED.","0801063-3","LT-00012","8LS3-J to AHL another order","Kashif Shamsuddin","-","164","Limit Switch","8LS3-J","5","7250","36250.00","42412.50","42412.50","GST","18-Jun-2019 12:53:20 PM","18-Jun-2019 12:53:20 PM");
INSERT INTO sales VALUES("63","SR-00006","9","SILVER LINKS","23568-9","LT-00012","Request for instruments sale","Kashif Shamsuddin","-","13","Magnehalic Gauge","Mark |||","20","50000","1000000.00","1170000.00","17462250.00","GST","18-Jun-2019 4:33:04 PM","18-Jun-2019 4:33:04 PM");
INSERT INTO sales VALUES("64","SR-00006","9","SILVER LINKS","23568-9","LT-00012","Request for instruments sale","Kashif Shamsuddin","-","14","Controller","NX","25","545000","13625000.00","15941250.00","17462250.00","GST","18-Jun-2019 4:33:04 PM","18-Jun-2019 4:33:04 PM");
INSERT INTO sales VALUES("65","SR-00006","9","SILVER LINKS","23568-9","LT-00000","Request for instruments sale","Kashif Shamsuddin","-","3","VFD","VX-100","30","10000","300000.00","351000.00","17462250.00","GST","18-Jun-2019 4:33:04 PM","18-Jun-2019 4:33:04 PM");



CREATE TABLE `scvaluations` (
  `sc_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sc_number` varchar(150) NOT NULL,
  `sc_name` varchar(100) NOT NULL,
  `sc_title` varchar(150) NOT NULL,
  `sc_area` varchar(200) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `sc_supplier` varchar(100) NOT NULL,
  `sc_item` varchar(100) NOT NULL,
  `sc_size` varchar(100) NOT NULL,
  `sc_specs` varchar(150) NOT NULL,
  `sc_description` varchar(200) NOT NULL,
  `sc_quantity` varchar(100) NOT NULL,
  `sc_unitprice` varchar(100) NOT NULL,
  `sc_totalprice` varchar(150) NOT NULL,
  `sc_exppu` varchar(150) NOT NULL,
  `sc_ucp` varchar(150) NOT NULL,
  `lot_number` varchar(200) NOT NULL,
  `sc_freight` varchar(100) NOT NULL,
  `sc_labour` varchar(100) NOT NULL,
  `sc_miscellaneous` varchar(100) NOT NULL,
  `sc_costunit` varchar(200) NOT NULL,
  `sc_totalunits` varchar(100) NOT NULL,
  `sc_totalexpense` varchar(150) NOT NULL,
  `sc_ppexpense` varchar(150) NOT NULL,
  `sc_grandtotal` varchar(200) NOT NULL,
  `sc_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`sc_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO scvaluations VALUES("1","PR-00000","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","60","800","48000","5666.67","6466.67","LT-00004","25000","250000","65000","388000.20","60","340000","5666.67","388000.20","0","22-Mar-2019","22-Mar-2019");
INSERT INTO scvaluations VALUES("2","PR-00001","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","150","32625","4893750","933.33","33558.33","LT-00005","40000","65000","35000","5033749.50","150","140000","933.33","5033749.50","0","04-Apr-2019","04-Apr-2019");
INSERT INTO scvaluations VALUES("3","PR-00002","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","200","5000","1000000","490.00","5490.00","LT-00006","10000","68000","20000","1098000.00","200","98000","490.00","1098000.00","0","04-Apr-2019","04-Apr-2019");
INSERT INTO scvaluations VALUES("4","PR-00004","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","8000","800000","0.00","8000.00","LT-00008","0","0","0","800000.00","100","0","0.00","800000.00","0","05-Apr-2019","05-Apr-2019");
INSERT INTO scvaluations VALUES("5","PR-00005","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","100","10","1000","245.00","2450.00","LT-00009","15000","15000","5000","245000.00","100","35000","245.00","245000","0","05-Apr-2019","05-Apr-2019");
INSERT INTO scvaluations VALUES("6","PR-00006","Kashif Shamsuddin","Request for Instruments","-","xyz","2","Azbil","Azbil","Controller","NX","NX 70","--","150","8000","1200000","1.00","8000.00","LT-00010","0","0","-204000","1200000.00","150","-204000","1.00","1200000","0","05-Apr-2019","05-Apr-2019");
INSERT INTO scvaluations VALUES("7","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description","100","25","2500","213.09","5327.25","LT-00011","25000","150000","3500","532725.00","150","178500","213.09","724500","0","10-Apr-2019 4:46:15 PM","10-Apr-2019 4:46:15 PM");
INSERT INTO scvaluations VALUES("8","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","18","900","213.09","3835.62","LT-00011","25000","150000","3500","191781.00","150","178500","213.09","724500","0","10-Apr-2019 4:46:15 PM","10-Apr-2019 4:46:15 PM");
INSERT INTO scvaluations VALUES("9","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","50","3000","150000","150.21","450630.00","LT-00012","12000","14000","16000","22531500.00","500","42000","150.21","300417000","0","30-May-2019 3:00:26 PM","30-May-2019 3:00:26 PM");
INSERT INTO scvaluations VALUES("10","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description 2","100","3500","350000","150.21","525735.00","LT-00012","12000","14000","16000","52573500.00","500","42000","150.21","300417000","0","30-May-2019 3:00:26 PM","30-May-2019 3:00:26 PM");
INSERT INTO scvaluations VALUES("11","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Kinda","VFD","VX-100","test specs","test description 3","150","4000","600000","150.21","600840.00","LT-00012","12000","14000","16000","90126000.00","500","42000","150.21","300417000","0","30-May-2019 3:00:26 PM","30-May-2019 3:00:26 PM");
INSERT INTO scvaluations VALUES("12","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","China","Office Chair","-","Comfortable Chair for long sittings","test description 4","200","4500","900000","150.21","675945.00","LT-00012","12000","14000","16000","135189000.00","500","42000","150.21","300417000","0","30-May-2019 3:00:26 PM","30-May-2019 3:00:26 PM");



CREATE TABLE `spayments` (
  `sp_ID` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(100) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `sp_amount` varchar(150) NOT NULL,
  `sp_description` varchar(200) NOT NULL,
  `vr_no` varchar(150) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`sp_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO spayments VALUES("1","0","2","Azbil","6858","Test Descritption","CT-00000","25-Mar-2019","25-Mar-2019");
INSERT INTO spayments VALUES("2","0","1","Dwyer","92000","bill for the month of novemebr 2018","CT-00004","03-Apr-2019","03-Apr-2019");
INSERT INTO spayments VALUES("3","0","1","Dwyer","28000","For PR-00002","CT-00005","03-Apr-2019","03-Apr-2019");
INSERT INTO spayments VALUES("4","0","3","Kinda","83360","Payment for PR-00003","BT-00001","03-Apr-2019","03-Apr-2019");
INSERT INTO spayments VALUES("5","0","1","Dwyer","100000","Test payable","CT-00006","05-Apr-2019","05-Apr-2019");
INSERT INTO spayments VALUES("6","0","1","Dwyer","3250","Test Receivable","CT-00007","05-Apr-2019","05-Apr-2019");
INSERT INTO spayments VALUES("7","0","1","Dwyer","70000","Test Receivable","BT-00002","05-Apr-2019","05-Apr-2019");
INSERT INTO spayments VALUES("8","0","1","Dwyer","20000","Test Receivable","BT-00003","05-Apr-2019","05-Apr-2019");
INSERT INTO spayments VALUES("9","0","2","Azbil","2000","Test Receivable","CT-00011","02-Apr-2019 12:30 PM","02-Apr-2019 12:30 PM");
INSERT INTO spayments VALUES("10","0","1","Dwyer","50000","Payment against PR-00010","BT-00003","23-Apr-2019 11:28:59 AM","23-Apr-2019 11:28:59 AM");



CREATE TABLE `squotations` (
  `sq_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sq_number` varchar(150) NOT NULL,
  `fr_ID` varchar(100) NOT NULL,
  `fr_name` varchar(100) NOT NULL,
  `fr_cnic` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `fr_gst` varchar(150) NOT NULL,
  `fr_address` varchar(200) NOT NULL,
  `sq_term` varchar(50) NOT NULL,
  `lot_number` varchar(200) NOT NULL,
  `sq_title` varchar(150) NOT NULL,
  `sq_name` varchar(100) NOT NULL,
  `sq_area` varchar(150) NOT NULL,
  `sq_i_ID` varchar(100) NOT NULL,
  `sq_item` varchar(100) NOT NULL,
  `sq_size` varchar(100) NOT NULL,
  `sq_quantity` varchar(100) NOT NULL,
  `sq_saleprice` varchar(150) NOT NULL,
  `sq_strate` varchar(100) NOT NULL,
  `sq_stamount` varchar(150) NOT NULL,
  `sq_total` varchar(150) NOT NULL,
  `sq_totalprice` varchar(150) NOT NULL,
  `sq_totalst` varchar(150) NOT NULL,
  `sq_totalesaletax` varchar(200) NOT NULL,
  `sq_grandtotal` varchar(200) NOT NULL,
  `dc_number` varchar(150) NOT NULL,
  `sq_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`sq_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO squotations VALUES("1","SR-00000","9","SILVER LINKS","23568-9","9-86532","Devis Road Lahore","Credit","LT-00000","Request for instruments supply","Kashif Shamsuddin","-","1","Magnehalic Gauge","Mark |||","18","13000","17","39780","234000","273780.00","97750.00","575000","672750.00","00000/2019","1","22-Mar-2019","22-Mar-2019");
INSERT INTO squotations VALUES("2","SR-00000","9","SILVER LINKS","23568-9","9-86532","Devis Road Lahore","Credit","LT-00000","Request for instruments supply","Kashif Shamsuddin","-","2","Controller","NX","11","10000","17","18700","110000","128700.00","97750.00","575000","672750.00","00000/2019","1","22-Mar-2019","22-Mar-2019");
INSERT INTO squotations VALUES("3","SR-00000","9","SILVER LINKS","23568-9","9-86532","Devis Road Lahore","Credit","LT-00000","Request for instruments supply","Kashif Shamsuddin","-","3","VFD","VX-100","21","11000","17","39270","231000","270270.00","97750.00","575000","672750.00","00000/2019","1","22-Mar-2019","22-Mar-2019");
INSERT INTO squotations VALUES("4","SR-00001","11","Waleed Sons","214578","369875","Mall Road Lahore","Credit","LT-00000","Request for instruments","Kashif Shamsuddin","-","1","Magnehalic Gauge","Mark |||","20","13000","17","44200","260000","304200.00","44200.00","260000","304200.00","00001/2019","1","29-Mar-2019","29-Mar-2019");
INSERT INTO squotations VALUES("5","SR-00002","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00004","Request for instruments supply","Kashif Shamsuddin","-","4","Magnehalic Gauge","Mark |||","60","10000","0","0","600000","600000.00","0.00","600000","600000.00","00002/2019","1","05-Apr-2019","05-Apr-2019");
INSERT INTO squotations VALUES("6","SR-00003","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00000","Request for instruments","Kashif Shamsuddin","-","2","Controller","NX","10","12000","17","20400","120000","140400.00","20400.00","120000","140400.00","00003/2019","1","05-Apr-2019","05-Apr-2019");
INSERT INTO squotations VALUES("7","SR-00004","10","SAHARA CHEMICALS","23568-99","987420-22","Sheikhupura Road Lahore","Credit","LT-00005","Request for instruments","Kashif Shamsuddin","-","5","Magnehalic Gauge","Mark |||","30","35000","17","178500","1050000","1228500.00","178500.00","1050000","1228500.00","00004/2019","1","05-Apr-2019","05-Apr-2019");
INSERT INTO squotations VALUES("8","SR-00005","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00000","Request for instruments supply","Kashif Shamsuddin","-","2","Controller","NX","10","9500","17","16150.00","95000.00","111150.00","45900.00","270000","315900.00","00005/2019","1","18-Jun-2019 12:28:38 PM","18-Jun-2019 12:28:38 PM");
INSERT INTO squotations VALUES("9","SR-00005","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00005","Request for instruments supply","Kashif Shamsuddin","-","5","Magnehalic Gauge","Mark |||","5","35000","17","29750.00","175000.00","204750.00","45900.00","270000","315900.00","00005/2019","1","18-Jun-2019 12:28:38 PM","18-Jun-2019 12:28:38 PM");
INSERT INTO squotations VALUES("10","SR-00006","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00012","Request for instruments sale","Kashif Shamsuddin","-","13","Magnehalic Gauge","Mark |||","20","50000","17","170000.00","1000000.00","1170000.00","2537250.00","14925000","17462250.00","00006/2019","1","18-Jun-2019 4:24:38 PM","18-Jun-2019 4:24:38 PM");
INSERT INTO squotations VALUES("11","SR-00006","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00012","Request for instruments sale","Kashif Shamsuddin","-","14","Controller","NX","25","545000","17","2316250.00","13625000.00","15941250.00","2537250.00","14925000","17462250.00","00006/2019","1","18-Jun-2019 4:24:38 PM","18-Jun-2019 4:24:38 PM");
INSERT INTO squotations VALUES("12","SR-00006","9","SILVER LINKS","23568-9","987420-2","Devis Road Lahore","Credit","LT-00000","Request for instruments sale","Kashif Shamsuddin","-","3","VFD","VX-100","30","10000","17","51000.00","300000.00","351000.00","2537250.00","14925000","17462250.00","00006/2019","1","18-Jun-2019 4:24:38 PM","18-Jun-2019 4:24:38 PM");



CREATE TABLE `srequisitions` (
  `sr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sr_number` varchar(150) NOT NULL,
  `sr_title` varchar(100) NOT NULL,
  `sr_name` varchar(100) NOT NULL,
  `sr_area` varchar(100) NOT NULL,
  `sr_supplier` varchar(100) NOT NULL,
  `sr_item` varchar(100) NOT NULL,
  `sr_size` varchar(100) NOT NULL,
  `sr_specs` varchar(150) NOT NULL,
  `sr_description` varchar(200) NOT NULL,
  `sr_quantity` varchar(100) NOT NULL,
  `sr_status` int(11) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO srequisitions VALUES("1","SR-00000","Request for instruments supply","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","Test Description","18","2","22-Mar-2019","22-Mar-2019");
INSERT INTO srequisitions VALUES("2","SR-00000","Request for instruments supply","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","Test Description","11","2","22-Mar-2019","22-Mar-2019");
INSERT INTO srequisitions VALUES("3","SR-00000","Request for instruments supply","Kashif Shamsuddin","-","Kinda","VFD","VX-100","test specs","Test Description","21","2","22-Mar-2019","22-Mar-2019");
INSERT INTO srequisitions VALUES("6","SR-00001","Request for instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","Test Description","20","2","29-Mar-2019","29-Mar-2019");
INSERT INTO srequisitions VALUES("7","SR-00002","Request for instruments supply","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","20","2","05-Apr-2019","05-Apr-2019");
INSERT INTO srequisitions VALUES("8","SR-00003","Request for instruments","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","Test Description","10","2","05-Apr-2019","05-Apr-2019");
INSERT INTO srequisitions VALUES("9","SR-00004","Request for instruments","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","Test Description","30","2","05-Apr-2019","05-Apr-2019");
INSERT INTO srequisitions VALUES("10","SR-00005","Request for instruments supply","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","Test Description","20","2","12-Apr-2019 11:19:30 AM","12-Apr-2019 11:19:30 AM");
INSERT INTO srequisitions VALUES("11","SR-00006","Request for instruments sale","Kashif Shamsuddin","-","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","20","2","18-Jun-2019 4:21:14 PM","18-Jun-2019 4:21:14 PM");
INSERT INTO srequisitions VALUES("12","SR-00006","Request for instruments sale","Kashif Shamsuddin","-","Azbil","Controller","NX","NX 70","test description 2","25","2","18-Jun-2019 4:21:14 PM","18-Jun-2019 4:21:14 PM");
INSERT INTO srequisitions VALUES("13","SR-00006","Request for instruments sale","Kashif Shamsuddin","-","Kinda","VFD","VX-100","test specs","test description 3","30","2","18-Jun-2019 4:21:14 PM","18-Jun-2019 4:21:14 PM");



CREATE TABLE `stocks` (
  `ss_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ss_number` varchar(100) NOT NULL,
  `ss_name` varchar(100) NOT NULL,
  `ss_title` varchar(150) NOT NULL,
  `ss_area` varchar(100) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_ID` varchar(100) NOT NULL,
  `s_company` varchar(150) NOT NULL,
  `ss_supplier` varchar(100) NOT NULL,
  `ss_item` varchar(100) NOT NULL,
  `ss_size` varchar(100) NOT NULL,
  `ss_specs` varchar(150) NOT NULL,
  `ss_description` varchar(200) NOT NULL,
  `ss_quantity` varchar(150) NOT NULL,
  `ss_unitprice` varchar(100) NOT NULL,
  `lot_number` varchar(150) NOT NULL,
  `ss_costunit` varchar(100) NOT NULL,
  `ss_saleprice` varchar(100) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`ss_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO stocks VALUES("1","0","Kashif Shamsuddin","Added from Products","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","6 Pascal","-","62","0","LT-00000","11500","0","22-Mar-2019","09-Apr-2019 4:38 PM");
INSERT INTO stocks VALUES("2","0","Kashif Shamsuddin","Added from Products","","xyz","2","Azbil","Azbil","Controller","NX","NX 70","-","69","0","LT-00000","8500","0","22-Mar-2019","18-Jun-2019 1:20 PM");
INSERT INTO stocks VALUES("3","0","Kashif Shamsuddin","Added from Products","","abc","3","Kinda","Kinda","VFD","VX-100","test specs","-","49","0","LT-00000","9300","0","22-Mar-2019","18-Jun-2019 4:33 PM");
INSERT INTO stocks VALUES("4","PR-00000","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","0","800","LT-00004","6466.67","0","22-Mar-2019","05-Apr-2019 9:55 AM");
INSERT INTO stocks VALUES("5","PR-00001","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","115","32625","LT-00005","33558.33","0","04-Apr-2019","18-Jun-2019 1:20 PM");
INSERT INTO stocks VALUES("6","0","Kashif Shamsuddin","Added From Products","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","200","0","LT-00000","5400","0","04-Apr-2019","09-Apr-2019 4:24 PM");
INSERT INTO stocks VALUES("7","PR-00004","Kashif Shamsuddin","Request for Instruments","-","ABC Supplier","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description","100","7000","LT-00008","8000.00","0","05-Apr-2019","09-Apr-2019 4:34 PM");
INSERT INTO stocks VALUES("8","PR-00005","Kashif Shamsuddin","Request for Instruments","-","abc","3","Kinda","Kinda","VFD","VX-100","test specs","test description","100","10","LT-00009","2450.00","0","05-Apr-2019","05-Apr-2019");
INSERT INTO stocks VALUES("9","PR-00006","Kashif Shamsuddin","Request for Instruments","-","xyz","2","Azbil","Azbil","Controller","NX","NX 70","--","150","8000","LT-00010","8000.00","0","05-Apr-2019","05-Apr-2019");
INSERT INTO stocks VALUES("10","0","Kashif Shamsuddin","Added from Products","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","Products Added From the stock list","200","0","LT-00000","4500","0","09-Apr-2019","09-Apr-2019");
INSERT INTO stocks VALUES("11","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description","100","25","LT-00011","5327.25","0","10-Apr-2019 4:46:15 PM","10-Apr-2019 4:46:15 PM");
INSERT INTO stocks VALUES("12","PR-00008","Kashif Shamsuddin","Request for Instruments","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","-","50","18","LT-00011","3835.62","0","10-Apr-2019 4:46:15 PM","10-Apr-2019 4:46:15 PM");
INSERT INTO stocks VALUES("13","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Dwyer","Magnehalic Gauge","Mark |||","60 Pascal","test description 1","30","3000","LT-00012","450630.00","0","30-May-2019 3:00:26 PM","18-Jun-2019 4:33 PM");
INSERT INTO stocks VALUES("14","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Azbil","Controller","NX","NX 70","test description 2","75","3500","LT-00012","525735.00","0","30-May-2019 3:00:26 PM","18-Jun-2019 4:33 PM");
INSERT INTO stocks VALUES("15","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","Kinda","VFD","VX-100","test specs","test description 3","150","4000","LT-00012","600840.00","0","30-May-2019 3:00:26 PM","30-May-2019 3:00:26 PM");
INSERT INTO stocks VALUES("16","PR-00011","Kashif Shamsuddin","test title","-","Mr Tom Henry","1","Dwyer","China","Office Chair","-","Comfortable Chair for long sittings","test description 4","200","4500","LT-00012","675945.00","0","30-May-2019 3:00:26 PM","30-May-2019 3:00:26 PM");



CREATE TABLE `suppliers` (
  `s_ID` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(100) NOT NULL,
  `s_phone` bigint(11) unsigned zerofill NOT NULL,
  `s_company` varchar(200) NOT NULL,
  `s_obalance` varchar(100) NOT NULL,
  `s_balance` varchar(100) NOT NULL,
  `s_duedate` varchar(150) NOT NULL,
  `created_at` varchar(150) NOT NULL,
  `updated_at` varchar(150) NOT NULL,
  PRIMARY KEY (`s_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO suppliers VALUES("1","Mr Tom Henry","03237806379","Dwyer","120000","321943000","06-Apr-2019","04-Feb-2019 11:40 AM","05-Apr-2019 11:54 AM");
INSERT INTO suppliers VALUES("2","xyz","00011515515","Azbil","0","4331500","04-Feb-2019 ","14-Feb-2019 2:21 PM","14-Feb-2019 2:21 PM");
INSERT INTO suppliers VALUES("3","abc","00054815854","Kinda","0","1782000","04-Feb-2019 ","14-Feb-2019 2:21 PM","14-Feb-2019 2:21 PM");
INSERT INTO suppliers VALUES("4","abc","03237806378","BRIGHTO PAINTS","0","-23","2019-04-10","10-Apr-2019 10:28 AM","10-Apr-2019 10:28 AM");
INSERT INTO suppliers VALUES("5","XYZ","01234564879","China","0","0","2019-04-02","15-Apr-2019 12:43 PM","15-Apr-2019 12:43 PM");



CREATE TABLE `teachers` (
  `tr_ID` int(50) NOT NULL AUTO_INCREMENT,
  `tr_name` varchar(50) NOT NULL,
  `tr_fname` varchar(50) NOT NULL,
  `tr_gender` varchar(50) NOT NULL,
  `tr_cnic` bigint(13) unsigned zerofill NOT NULL,
  `tr_phone` bigint(11) unsigned zerofill NOT NULL,
  `tr_address` varchar(250) NOT NULL,
  `tr_city` varchar(50) NOT NULL,
  `tr_quota` int(100) NOT NULL,
  `tr_quota_validfrom` varchar(100) NOT NULL,
  `tr_quota_validtill` varchar(100) NOT NULL,
  `assoc_city` varchar(50) NOT NULL,
  `assoc_area` varchar(50) NOT NULL,
  `assoc_ID` int(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`tr_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO teachers VALUES("2","test","test","Male","3520242147733","03237806378","Lahore","Lahore","100000","2019-01-31","2019-01-24","Lahore","Model Town","1","2019-01-31 10:14:49","2019-01-31 10:14:49");



CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerview` tinyint(1) NOT NULL DEFAULT '0',
  `customeradd` tinyint(1) NOT NULL DEFAULT '0',
  `customeredit` tinyint(1) NOT NULL DEFAULT '0',
  `customerdelete` tinyint(1) NOT NULL DEFAULT '0',
  `assetledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `bankslistview` tinyint(1) NOT NULL DEFAULT '0',
  `bankslistadd` tinyint(1) NOT NULL DEFAULT '0',
  `bankslistedit` tinyint(1) NOT NULL DEFAULT '0',
  `bankslistdelete` tinyint(1) NOT NULL DEFAULT '0',
  `bankaccountsview` tinyint(1) NOT NULL DEFAULT '0',
  `bankaccountsadd` tinyint(1) NOT NULL DEFAULT '0',
  `bankaccountsedit` tinyint(1) NOT NULL DEFAULT '0',
  `bankaccountsdelete` tinyint(1) NOT NULL DEFAULT '0',
  `cashaccountsview` tinyint(1) NOT NULL DEFAULT '0',
  `cashaccountsadd` tinyint(1) NOT NULL DEFAULT '0',
  `cashaccountsedit` tinyint(1) NOT NULL DEFAULT '0',
  `cashaccountsdelete` tinyint(1) NOT NULL DEFAULT '0',
  `assetsview` tinyint(1) NOT NULL DEFAULT '0',
  `assetsadd` tinyint(1) NOT NULL DEFAULT '0',
  `assetsedit` tinyint(1) NOT NULL DEFAULT '0',
  `assetsdelete` tinyint(1) NOT NULL DEFAULT '0',
  `liabilitiesview` tinyint(1) NOT NULL DEFAULT '0',
  `liabilitiesadd` tinyint(1) NOT NULL DEFAULT '0',
  `liabilitiesedit` tinyint(1) NOT NULL DEFAULT '0',
  `liabilitiesdelete` tinyint(1) NOT NULL DEFAULT '0',
  `expenseview` tinyint(1) NOT NULL DEFAULT '0',
  `expenseadd` tinyint(1) NOT NULL DEFAULT '0',
  `expenseedit` tinyint(1) NOT NULL DEFAULT '0',
  `expensedelete` tinyint(1) NOT NULL DEFAULT '0',
  `incomeview` tinyint(1) NOT NULL DEFAULT '0',
  `incomeadd` tinyint(1) NOT NULL DEFAULT '0',
  `incomeedit` tinyint(1) NOT NULL DEFAULT '0',
  `incomedelete` tinyint(1) NOT NULL DEFAULT '0',
  `subtypesview` tinyint(1) NOT NULL DEFAULT '0',
  `subtypesadd` tinyint(1) NOT NULL DEFAULT '0',
  `subtypesedit` tinyint(1) NOT NULL DEFAULT '0',
  `subtypesdelete` tinyint(1) NOT NULL DEFAULT '0',
  `cpaymentsview` tinyint(1) NOT NULL DEFAULT '0',
  `cpaymentsadd` tinyint(1) NOT NULL DEFAULT '0',
  `bpaymentsview` tinyint(1) NOT NULL DEFAULT '0',
  `bpaymentsadd` tinyint(1) NOT NULL DEFAULT '0',
  `creceiptsview` tinyint(1) NOT NULL DEFAULT '0',
  `creceiptsadd` tinyint(1) NOT NULL DEFAULT '0',
  `breceiptsveiw` tinyint(1) NOT NULL DEFAULT '0',
  `breceiptsadd` tinyint(1) NOT NULL DEFAULT '0',
  `jvview` tinyint(1) NOT NULL DEFAULT '0',
  `jvadd` tinyint(1) NOT NULL DEFAULT '0',
  `cashledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `bankledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `expenseledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `liabilitiesledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `incomeledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `customerledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `supplierledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `purchaseledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `salesledgersview` tinyint(1) NOT NULL DEFAULT '0',
  `trialbalanceview` tinyint(1) NOT NULL DEFAULT '0',
  `incomestatementview` tinyint(1) NOT NULL DEFAULT '0',
  `suppliersview` tinyint(1) DEFAULT '0',
  `suppliersadd` tinyint(1) NOT NULL DEFAULT '0',
  `suppliersedit` tinyint(1) NOT NULL DEFAULT '0',
  `suppliersdelete` tinyint(1) NOT NULL DEFAULT '0',
  `productsview` tinyint(1) NOT NULL DEFAULT '0',
  `productsadd` tinyint(1) NOT NULL DEFAULT '0',
  `productsedit` tinyint(1) NOT NULL DEFAULT '0',
  `productsdelete` tinyint(1) NOT NULL DEFAULT '0',
  `stockview` tinyint(1) NOT NULL DEFAULT '0',
  `stockedit` tinyint(1) NOT NULL DEFAULT '0',
  `grossprofitview` tinyint(1) NOT NULL DEFAULT '0',
  `dbbackupview` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","Kashif Shamsuddin","starautomation83n@gmail.com","Admin","$2y$10$lGRu4H9/mUb4extgj21tn.n1InLlnZVqdEHolXwhqO00fvLswrGaS","Qw2DPQjdIoGZclD8XBbPllhCCX5EoGGAL3yuBYJvlFmHjvg7D5qehm36LTZK","1","1","1","1","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","2019-01-31 07:39:36","2019-01-31 07:39:36");
INSERT INTO users VALUES("3","Imran","operator@starautomation.net","Operator","$2y$10$edirGCuv1RVUe7oBeiiAuur6Wb8s6KskhkLOzWArGMIjMkWMrACK2","4oN4wD032mwQ8L0mo2cE5cncmDwKsKdghuPFx7kn6hC0H77zhbi3L2zOcmzt","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","2019-06-20 10:01:07","2019-06-20 10:01:07");

