

CREATE TABLE `assignment_details` (
  `status` int(1) NOT NULL,
  `assingmentdetai_key` int(11) NOT NULL AUTO_INCREMENT,
  `assignmentmgt_key` int(11) NOT NULL,
  `student_key` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `subject_key` int(11) NOT NULL,
  `curstatusofbatch_key` int(11) NOT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`assingmentdetai_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO assignment_details VALUES("1","1","1","3","20","17","4","2020-03-21 23:19:42","5");
INSERT INTO assignment_details VALUES("0","2","1","3","40","17","4","2020-03-21 23:22:01","5");
INSERT INTO assignment_details VALUES("1","3","3","3","20","17","4","2020-04-09 07:59:10","5");



CREATE TABLE `assignmentmgt_master` (
  `status` int(1) NOT NULL,
  `assignmentmgtmas_key` int(11) NOT NULL AUTO_INCREMENT,
  `datos` date NOT NULL,
  `subject_key` int(11) NOT NULL,
  `curstateofbatch_key` int(11) NOT NULL,
  `lecture_key` int(11) NOT NULL,
  `method` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `marks` int(11) NOT NULL,
  `complete_status` int(1) DEFAULT NULL,
  `complete_dte` date DEFAULT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`assignmentmgtmas_key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO assignmentmgt_master VALUES("0","1","2020-03-21","17","4","1","Written Paper","Create a Paragraph and Wordart Set and Mail Merge","100","1","2020-03-21","2020-03-21 22:49:36","5");
INSERT INTO assignmentmgt_master VALUES("0","2","2020-03-24","16","4","1","Written Paper","as","100","1","2020-03-24","2020-03-24 16:23:07","5");
INSERT INTO assignmentmgt_master VALUES("0","3","2020-04-09","17","4","1","Written Paper","addsa","100","1","2020-04-09","2020-04-09 07:58:43","5");
INSERT INTO assignmentmgt_master VALUES("0","4","2020-04-13","17","4","1","Written Paper","Create Tabless","100","0","0000-00-00","2020-04-09 09:07:38","5");
INSERT INTO assignmentmgt_master VALUES("0","5","2020-04-23","17","4","1","Ws","as","100","0","0000-00-00","2020-04-09 09:08:33","5");
INSERT INTO assignmentmgt_master VALUES("0","6","2020-05-14","17","4","1","","","12","0","0000-00-00","2020-05-07 04:44:06","5");
INSERT INTO assignmentmgt_master VALUES("0","7","2020-05-20","17","4","1","oral","xa","50","0","0000-00-00","2020-05-12 11:54:56","5");



CREATE TABLE `attendance_details` (
  `status` int(1) NOT NULL,
  `attendance_key` int(11) NOT NULL AUTO_INCREMENT,
  `lecturedtemgt_key` int(11) NOT NULL,
  `student_key` int(11) NOT NULL,
  `subject_key` int(11) NOT NULL,
  `curstatusofbatch_key` int(11) NOT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`attendance_key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO attendance_details VALUES("1","1","2","3","17","4","2020-03-21 13:14:26","5");
INSERT INTO attendance_details VALUES("1","2","2","3","17","4","2020-03-21 13:50:51","5");
INSERT INTO attendance_details VALUES("1","3","6","3","17","4","2020-04-07 13:16:00","5");
INSERT INTO attendance_details VALUES("1","4","6","3","17","4","2020-04-07 13:16:37","5");
INSERT INTO attendance_details VALUES("0","5","1","3","17","4","2020-04-09 08:33:53","5");
INSERT INTO attendance_details VALUES("1","6","11","3","16","4","2020-05-07 04:41:40","5");
INSERT INTO attendance_details VALUES("0","7","1","8","50","11","2020-08-08 06:53:10","19");
INSERT INTO attendance_details VALUES("0","8","1","9","50","11","2020-08-08 06:53:20","19");



CREATE TABLE `batch_master` (
  `status` int(1) NOT NULL,
  `batch_mas_key` int(11) NOT NULL AUTO_INCREMENT,
  `facalty_key` int(11) NOT NULL,
  `course_key` int(11) NOT NULL,
  `batch_code` varchar(150) NOT NULL,
  `batch_year` int(11) NOT NULL,
  PRIMARY KEY (`batch_mas_key`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

INSERT INTO batch_master VALUES("1","1","1","1","2015IT","2015");
INSERT INTO batch_master VALUES("1","2","1","1","2016IT","2016");
INSERT INTO batch_master VALUES("1","3","1","1","2017IT","2017");
INSERT INTO batch_master VALUES("1","4","1","4","2020CIT","2020");
INSERT INTO batch_master VALUES("1","5","4","6","2020NCAT1 ","2020");
INSERT INTO batch_master VALUES("1","6","5","7","2020ICT2","2020");
INSERT INTO batch_master VALUES("1","7","1","8","2020GD1","2020");
INSERT INTO batch_master VALUES("1","8","4","6","0099","2022");
INSERT INTO batch_master VALUES("1","9","1","8","2020GD2","2020");
INSERT INTO batch_master VALUES("1","10","1","11","2021ECC25","2021");
INSERT INTO batch_master VALUES("0","11","6","12","2019BSC 04","2019");
INSERT INTO batch_master VALUES("0","12","6","13","2020ESC","2020");
INSERT INTO batch_master VALUES("1","13","1","14","2020ESC","2020");
INSERT INTO batch_master VALUES("1","14","1","15","2020ECC 31","2020");
INSERT INTO batch_master VALUES("0","15","1","14","2020ECC 31","2020");
INSERT INTO batch_master VALUES("0","16","1","15","2019ECC 12.1 I","2019");
INSERT INTO batch_master VALUES("0","17","1","15","2020ECC 12.1 I","2020");
INSERT INTO batch_master VALUES("0","18","1","14","2019ECC 31","2019");
INSERT INTO batch_master VALUES("0","19","3","16","2019ECC 05","2019");
INSERT INTO batch_master VALUES("0","20","3","16","2020ECC 05","2020");
INSERT INTO batch_master VALUES("0","21","3","17","2020ECC 05","2020");
INSERT INTO batch_master VALUES("0","22","4","18","2020ECC 02","2020");
INSERT INTO batch_master VALUES("0","23","4","19","2020ETC 09.1","2020");
INSERT INTO batch_master VALUES("0","24","1","15","2020ECC 12.1 II","2020");



CREATE TABLE `course_master` (
  `status` int(1) NOT NULL,
  `course_key` int(11) NOT NULL AUTO_INCREMENT,
  `facalty_key` int(11) NOT NULL,
  `course_nme` varchar(150) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  PRIMARY KEY (`course_key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO course_master VALUES("1","1","1","Degree of Software Engineer","");
INSERT INTO course_master VALUES("1","2","1","Degree in Artificial Intelligance","");
INSERT INTO course_master VALUES("1","3","2","sd1","");
INSERT INTO course_master VALUES("1","4","1","Certificate Course of Information Tecnol","");
INSERT INTO course_master VALUES("1","5","4","Nati","");
INSERT INTO course_master VALUES("1","6","6","National Certificate of Accounting Technician ","");
INSERT INTO course_master VALUES("1","7","1","Information Communication Technology Technician ","");
INSERT INTO course_master VALUES("1","8","1","Graphic Design ","");
INSERT INTO course_master VALUES("1","9","1","National Certificate In Engineering Craft Practice (refrigeration & Air Conditioning Mechanic","");
INSERT INTO course_master VALUES("1","10","1","welding","E122");
INSERT INTO course_master VALUES("1","11","1","National Certificate of Wood","ECC25");
INSERT INTO course_master VALUES("0","12","6","National Certificate For Accounting Technicians","BSC 04");
INSERT INTO course_master VALUES("0","13","6","National Certificate For Secretary ","ESC");
INSERT INTO course_master VALUES("0","14","1","Certificate In Computer Graphic Designing","ECC 31");
INSERT INTO course_master VALUES("0","15","1","Information Communication Technology Technician","ECC 12.1");
INSERT INTO course_master VALUES("0","16","3","National Certificate In Engineering Craft Practice (refrigeration & Air Conditioning Mechanic)","ECC 05");
INSERT INTO course_master VALUES("0","17","3","National Certificate In Engineering Craft Practice (Gas & Arc Welder)","ECC 02");
INSERT INTO course_master VALUES("0","18","4","National Certificate In Technology (Mechanical Engineering â€“ Automobile Technology)","ETC 09.1");
INSERT INTO course_master VALUES("0","19","4","Diploma In Quantity Surveying Technology","ETB 17");



CREATE TABLE `cur_statusofbatch_details` (
  `status` int(11) NOT NULL,
  `curstatusbatch_detail_key` int(11) NOT NULL AUTO_INCREMENT,
  `acadamic_yer` int(11) NOT NULL,
  `batchmas_key` int(11) NOT NULL,
  `coursemas_key` int(11) NOT NULL,
  `semester_key` int(11) NOT NULL,
  `semesterstart_date` date NOT NULL,
  `semesterend_dte` date NOT NULL,
  `duration` varchar(10) NOT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`curstatusbatch_detail_key`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO cur_statusofbatch_details VALUES("1","1","2019","3","1","1","2019-01-15","2019-02-13","12","2020-02-26 10:10:20","3");
INSERT INTO cur_statusofbatch_details VALUES("1","2","2019","3","1","2","2019-10-21","2019-12-24","130Days","2020-02-26 10:11:04","3");
INSERT INTO cur_statusofbatch_details VALUES("1","3","2020","3","1","3","2020-02-26","2020-02-26","135Days","2020-02-26 10:11:24","3");
INSERT INTO cur_statusofbatch_details VALUES("1","4","2020","4","4","1","2020-01-01","2020-05-31","130 Days","2020-03-15 12:28:08","3");
INSERT INTO cur_statusofbatch_details VALUES("1","5","2020","4","4","2","2020-06-01","2020-12-31","135 Days","2020-03-15 12:28:42","3");
INSERT INTO cur_statusofbatch_details VALUES("1","6","2020","6","7","1","2020-07-01","2020-12-31","6 Manth ","2020-04-29 04:12:09","3");
INSERT INTO cur_statusofbatch_details VALUES("1","7","2020","9","8","1","2020-01-27","2020-07-13","6 Manth","2020-06-30 20:49:57","3");
INSERT INTO cur_statusofbatch_details VALUES("1","8","2020","7","8","1","2019-01-31","2019-06-28","6 Manth","2020-06-30 21:35:30","3");
INSERT INTO cur_statusofbatch_details VALUES("1","9","2021","10","11","1","2021-01-01","2021-03-01","12","2020-08-07 09:08:27","3");
INSERT INTO cur_statusofbatch_details VALUES("0","10","2019","18","14","2","2019-01-06","2019-12-12","6 Manth","2020-08-07 22:42:04","3");
INSERT INTO cur_statusofbatch_details VALUES("0","11","2020","15","14","1","2020-05-01","2020-06-30","6 Manth","2020-08-07 22:43:39","3");
INSERT INTO cur_statusofbatch_details VALUES("0","12","2020","12","13","1","2020-05-01","2020-12-31","12 ","2020-08-07 22:46:12","3");
INSERT INTO cur_statusofbatch_details VALUES("0","13","2020","24","15","2","2020-06-01","2020-12-31","6","2020-08-08 23:52:44","3");



CREATE TABLE `facalty_master` (
  `status` int(1) NOT NULL,
  `facalty_key` int(11) NOT NULL AUTO_INCREMENT,
  `facalty_nme` varchar(150) NOT NULL,
  PRIMARY KEY (`facalty_key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO facalty_master VALUES("0","1","Department of Trade ");
INSERT INTO facalty_master VALUES("0","3","Department of Engineering Day ");
INSERT INTO facalty_master VALUES("0","4","Department of Engineering Week End ");
INSERT INTO facalty_master VALUES("0","6","Department of Commerce ");



CREATE TABLE `lecture_master` (
  `status` int(1) NOT NULL,
  `lecturemas_key` int(11) NOT NULL AUTO_INCREMENT,
  `lecture_fullnme` varchar(250) NOT NULL,
  `lecture_nme` varchar(250) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `nic_no` varchar(20) NOT NULL,
  `email_address` varchar(150) DEFAULT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`lecturemas_key`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO lecture_master VALUES("1","1","Lahiru Chathuranga","G.A.L Chathuranga","94718664527","9232412132V","lahiruc700@gmail.com","2020-03-12 13:59:51","3");
INSERT INTO lecture_master VALUES("1","2","Gdd Sdd Amila Darshana","G.S Amila Darshana","0712343453","9345344234V","lahiruc700@gmail.com","2020-03-15 13:36:21","3");
INSERT INTO lecture_master VALUES("1","3","Kas Hiranthi perera","K.H. Perera","0712345674","892345345V","lahiruc700@gmail.com","2020-03-15 13:37:21","3");
INSERT INTO lecture_master VALUES("1","4","Gjdk Sdfg Vijith Susantha","G.S.V.Susantha","09133453453","928345634V","lahiruc700@gmail.com","2020-03-15 13:38:16","3");
INSERT INTO lecture_master VALUES("1","5","ssd Sss Kasun","s.s Kasun","0712343453","9871234v","lahiruc700@gmail.com","2020-04-04 18:47:25","3");
INSERT INTO lecture_master VALUES("1","6","jshd sdj Saman","J.S Saman","0712345673","98712347v","lahiruc800@gmail.com","2020-04-04 18:57:15","3");
INSERT INTO lecture_master VALUES("1","7","s","s","s","s","www.ssd.oeo","2020-05-03 07:43:19","3");
INSERT INTO lecture_master VALUES("1","8","sdsd","assd","1223123131","807790293V","nilmini@gmail","2020-05-23 03:37:39","3");
INSERT INTO lecture_master VALUES("0","9","Keembiya Liyanagamage Rashika Damayanthi","K L G Rashika Damayanthi","0718052430","198051003264","damayanthirashika@gmail.com","2020-06-29 23:29:35","3");
INSERT INTO lecture_master VALUES("1","10","asd","K L G Rashika Damayanthi","1234123414","727497297921731","asdada@gmail.com","2020-06-29 23:35:52","3");
INSERT INTO lecture_master VALUES("1","11","a","a","a","a","aa@gmail.com","2020-06-29 23:36:53","3");
INSERT INTO lecture_master VALUES("0","12","Saheli Ranasinghe ","S Ranasinghe","0705329514","869077293V","saheli.ranasinghe@gmail.com","2020-06-30 21:54:50","3");
INSERT INTO lecture_master VALUES("0","13","Ishankha Sandya Kumari Weerasekara","I S K Weerasekara","0711090654","866302243V","ishweerasekara@gmail.com","2020-06-30 21:56:22","3");
INSERT INTO lecture_master VALUES("1","14","jj","jj jj","jj","kkk","jj@gmail.com","2020-07-01 00:51:16","3");
INSERT INTO lecture_master VALUES("1","15","jn","mjk","kk","kk","nn@gmail.com","2020-08-03 03:12:57","3");
INSERT INTO lecture_master VALUES("1","16","Randika Lakshan","K P Randika ","0718667527","199077800243","RandikaLak@gmail.com","2020-08-07 08:20:54","3");
INSERT INTO lecture_master VALUES("0","17","Kelum Indika ","I Kelum","0718371474","840951715V","indika@dtet.gov.lk","2020-08-07 23:24:04","3");
INSERT INTO lecture_master VALUES("0","18","Kaluthantri Arachchige Lional ","K A Lional","0717226203","195835501085","lional@dtet.gov.lk","2020-08-07 23:26:56","3");
INSERT INTO lecture_master VALUES("0","19","Sunil Rathnjith Weerakoon","S R Weerakoon","0714422645","762692511V","weerakoon@dtet.gov.lk","2020-08-07 23:29:09","3");
INSERT INTO lecture_master VALUES("0","20","Hasitha Abewardhana ","H Abewardhana","0715357614","790803340V","hasithaabewardhana@gmail.com","2020-08-08 23:56:11","3");
INSERT INTO lecture_master VALUES("0","21","Mahinda Gamage","M Gamage","0714438932","7433929561V","mahindabandara@gmail.com","2020-08-09 00:04:25","3");



CREATE TABLE `lectureassign_details` (
  `status` int(1) NOT NULL,
  `lectureassign_detail_key` int(11) NOT NULL AUTO_INCREMENT,
  `lecture_key` int(11) NOT NULL,
  `cur_statusbatch_key` int(11) NOT NULL,
  `subject_key` int(11) NOT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`lectureassign_detail_key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO lectureassign_details VALUES("0","1","1","5","23","2020-03-15 13:32:58","3");
INSERT INTO lectureassign_details VALUES("0","2","1","5","25","2020-03-15 13:34:57","3");
INSERT INTO lectureassign_details VALUES("0","3","2","5","21","2020-03-15 13:38:43","3");
INSERT INTO lectureassign_details VALUES("0","4","3","5","22","2020-03-15 13:38:48","3");
INSERT INTO lectureassign_details VALUES("0","5","4","5","24","2020-03-15 13:38:54","3");
INSERT INTO lectureassign_details VALUES("0","6","3","5","26","2020-03-15 13:39:00","3");
INSERT INTO lectureassign_details VALUES("0","7","1","4","16","2020-03-15 13:39:18","3");
INSERT INTO lectureassign_details VALUES("0","8","1","4","17","2020-03-15 13:39:22","3");
INSERT INTO lectureassign_details VALUES("0","9","3","4","18","2020-03-15 13:39:27","3");
INSERT INTO lectureassign_details VALUES("0","10","4","4","19","2020-03-15 13:39:33","3");
INSERT INTO lectureassign_details VALUES("0","11","2","4","20","2020-03-15 13:39:39","3");
INSERT INTO lectureassign_details VALUES("0","12","13","8","31","2020-07-01 00:22:33","3");
INSERT INTO lectureassign_details VALUES("0","13","12","8","32","2020-07-01 00:24:15","3");
INSERT INTO lectureassign_details VALUES("0","14","13","8","33","2020-07-01 00:24:23","3");
INSERT INTO lectureassign_details VALUES("0","15","13","8","34","2020-07-01 00:25:46","3");
INSERT INTO lectureassign_details VALUES("0","16","9","11","49","2020-08-08 05:30:49","3");
INSERT INTO lectureassign_details VALUES("0","17","12","11","50","2020-08-08 05:32:20","3");
INSERT INTO lectureassign_details VALUES("0","18","9","11","51","2020-08-08 05:32:27","3");
INSERT INTO lectureassign_details VALUES("0","19","19","11","52","2020-08-08 05:32:46","3");



CREATE TABLE `lecturedtemgt_details` (
  `status` int(1) NOT NULL,
  `lecturedtemgtdetail_key` int(11) NOT NULL AUTO_INCREMENT,
  `datos` date NOT NULL,
  `subject_key` int(11) NOT NULL,
  `curstateofbatch_key` int(11) NOT NULL,
  `lecture_key` int(11) NOT NULL,
  `term_note` varchar(400) DEFAULT NULL,
  `lerning_hours` int(11) DEFAULT NULL,
  `pending_status` int(11) DEFAULT NULL,
  `shedule_key` int(11) DEFAULT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`lecturedtemgtdetail_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO lecturedtemgt_details VALUES("0","1","2020-08-08","50","11","12","finish","8","0","20","2020-08-08 06:51:59","19");



CREATE TABLE `shedule_details` (
  `status` int(1) NOT NULL,
  `sheduledetail_key` int(11) NOT NULL AUTO_INCREMENT,
  `curstausofbatch_key` int(11) NOT NULL,
  `subject_key` int(11) NOT NULL,
  `lesson_nme` varchar(200) NOT NULL,
  `shedule_dte` date NOT NULL,
  `acadamic_week` varchar(100) DEFAULT NULL,
  `hours` int(11) NOT NULL,
  `resource_cost` varchar(200) NOT NULL,
  `services_utility` varchar(200) NOT NULL,
  `learning_process` varchar(200) NOT NULL,
  `methodology` varchar(200) NOT NULL,
  `termnote_remark` varchar(200) NOT NULL,
  `complete_status` int(11) DEFAULT NULL,
  `complete_dte` date DEFAULT NULL,
  `complete_hours` int(11) DEFAULT NULL,
  `complete_lecturedtemgt` int(11) DEFAULT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`sheduledetail_key`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO shedule_details VALUES("0","1","4","17","Create different types of docments using templates","2020-03-17","1Week","3","","","","","","1","2020-03-21","3","2","2020-03-17 16:52:06","3");
INSERT INTO shedule_details VALUES("0","2","4","17"," Format Paragraph and Documents","2020-03-18","1Week","3","","","","","","1","2020-03-21","3","2","2020-03-17 16:53:44","3");
INSERT INTO shedule_details VALUES("0","3","4","17"," Format Paragraph and Documents","2020-03-19","1Week","3","","","","","","1","2020-04-07","2","6","2020-03-17 16:54:42","3");
INSERT INTO shedule_details VALUES("0","4","4","17","Format Paragraph and Documents","2020-03-20","1Week","3","","","","","","1","2020-04-07","1","6","2020-03-17 20:19:03","3");
INSERT INTO shedule_details VALUES("0","5","4","17","Add objects and special formatting","2020-03-23","2Week","3","","","","","","1","2020-03-20","-3","1","2020-03-17 20:20:04","3");
INSERT INTO shedule_details VALUES("0","6","4","17","Add objects and special formatting","2020-03-24","2Week","3","","","","","","0","0000-00-00","0","0","2020-03-17 20:20:19","3");
INSERT INTO shedule_details VALUES("0","7","4","17","Add objects and special formatting","2020-03-25","2Week","3","d1","f1","g1","h1","j1","0","0000-00-00","0","0","2020-03-17 20:20:30","5");
INSERT INTO shedule_details VALUES("0","8","4","17","Add objects and special formatting","2020-03-26","2Week","1","f1","d1","s1","a1","k1","0","0000-00-00","0","0","2020-03-17 20:20:44","5");
INSERT INTO shedule_details VALUES("0","9","4","17","Find and replace text","2020-03-26","2Week","1","","","","","","0","0000-00-00","0","0","2020-03-17 20:21:34","3");
INSERT INTO shedule_details VALUES("0","10","4","17","Create Tables","2020-03-26","2Week","2","","","","","","1","2020-04-30","-1","8","2020-03-17 20:21:59","5");
INSERT INTO shedule_details VALUES("0","11","4","17","Assignment","2020-03-30","3Week","4","","","","","","0","0000-00-00","0","0","2020-03-17 22:01:01","3");
INSERT INTO shedule_details VALUES("0","12","4","16","Identify software solution requirements","2020-04-04","1Week","2","Multimedia projector and Teacher Computer","Computer for each student","Listening, discussing, Observing and practising","Demonstration, Presentation","adasfas","0","0000-00-00","0","0","2020-04-04 19:37:33","5");
INSERT INTO shedule_details VALUES("0","13","4","16","Identify software solution requirements","2020-04-05","1Week","2","Multimedia projector and Teacher Computer1","Computer for each student","Listening, discussing, Observing and practising","Demonstration, Presentation","sdffas","0","0000-00-00","0","0","2020-04-04 19:40:23","5");
INSERT INTO shedule_details VALUES("0","14","4","16","Add objects and special formatting","2020-04-05","1Week","2","Multimedia projector and Teacher Computer","Computer for each student","Listening, discussing, Observing and practising","Demonstration, Presentation","asfsae","0","0000-00-00","0","0","2020-04-04 19:42:39","5");
INSERT INTO shedule_details VALUES("0","15","4","17","Create Tables","2020-04-07","2Week","5","Multimedia projector and Teacher Computer","Computer for each student","Listening, discussing, Observing and practising","Demonstration, Presentation","sadssaf","1","2020-05-12","3","13","2020-04-07 12:40:56","5");
INSERT INTO shedule_details VALUES("0","16","4","17","Create Tables","2020-04-08","1Week","3","Multimedia projector and Teacher Computer","Computer for each student","Listening, discussing, Observing and practising","Demonstration, Presentation","sad","1","2020-04-30","-3","8","2020-04-07 12:54:52","5");
INSERT INTO shedule_details VALUES("0","17","4","16","xxx","2020-05-01","1Week","5","yy","ss","dd","aadd","dd","0","0000-00-00","0","0","2020-04-30 10:04:46","5");
INSERT INTO shedule_details VALUES("0","18","4","17","xyz","2020-05-12","5Week","4","1222","233131","4121","dasdasd","ada","1","2020-05-12","4","13","2020-05-12 11:10:34","5");
INSERT INTO shedule_details VALUES("0","19","11","50","Prepare layout for printing process","2020-01-05","1Week","8","Multimeedia/computer","Network/Internet","Specifications of the product / scope identified in terms of printing process involved, according to type of print product ","Practical","Specifications of the product / scope identified in terms of printing process involved, according to type of print product ","1","2020-08-08","7","16","2020-08-08 06:15:10","19");
INSERT INTO shedule_details VALUES("0","20","11","50","Prepare graphics and images to suit the design concept","2020-01-07","3Week","8","Multimeedia/computer","Network/Internet","Specifications of the product / scope identified in terms of printing process involved, according to type of print product","Practical","Specifications of the product / scope identified in terms of printing process involved, according to type of print product","1","2020-08-08","4","1","2020-08-08 06:48:02","19");



CREATE TABLE `student_master` (
  `status` int(1) NOT NULL,
  `student_key` int(11) NOT NULL AUTO_INCREMENT,
  `batch_key` int(11) NOT NULL,
  `student_id` varchar(150) NOT NULL,
  `support_key` int(11) NOT NULL,
  `student_fullnme` varchar(200) NOT NULL,
  `initial_nme` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `nic_no` varchar(50) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `student_img` varchar(150) DEFAULT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`student_key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO student_master VALUES("0","1","3","2017IT-001","1","Ghh Jsd Himal Chathuranga","G.J Himal Chathuranga","1992-10-15","9442352319V","125,adf.ghjsdf","stu_1.png","2020-03-12 10:05:44","3");
INSERT INTO student_master VALUES("0","2","3","2017IT-002","2","Ghh Jsd Duminda Chathuranga","G.J Duminda Chathuranga","1992-10-13","9442352313V","126,adf.ghj","stu_2.png","2020-03-12 10:13:30","3");
INSERT INTO student_master VALUES("0","3","4","2020CIT-001","1","Ghh Jsd Ishan Chathuranga","G.J Ishan Chathuranga","1994-12-20","9442352313V","122,adf.ghj","stu_3.png","2020-03-12 10:15:15","3");
INSERT INTO student_master VALUES("0","4","6","2020ICT2-001","1","Kalani Anjana","K Anjana","2000-07-12","200077900293","11/4 , pahala witiyala","stu_4.jpg","2020-08-02 22:50:35","3");
INSERT INTO student_master VALUES("0","5","7","2020GD1-001","1","Thusitha","T K Kumari","1977-01-23","776580345V","dinithi,Kaburupitiya","stu_5.jpg","2020-08-07 08:47:41","3");
INSERT INTO student_master VALUES("0","6","18","2019ECC 31-001","1","Puhulwella Gamage Chandima Subhashini","P G C Subhashini","1994-12-25","948212579V","Kattadigahakoratuwa, Pallaththara, Modarawana.","stu_6.jpg","2020-08-08 00:48:09","3");
INSERT INTO student_master VALUES("0","7","18","2019ECC 31-002","2","Balage Ishara Sewwandi","B I Sewwandi","1994-10-04","947782487V","Janayage Watta,Waliara,Nawanaliya","stu_7.jpg","2020-08-08 00:51:48","3");
INSERT INTO student_master VALUES("0","8","15","2020ECC 31-001","1","Dilmi isanka Pathirana","I P ishanka","1999-01-03","19994328077V","Nidahasmawatha,Kamburupitiya","stu_8.jpg","2020-08-08 06:41:37","3");
INSERT INTO student_master VALUES("0","9","15","2020ECC 31-002","2","Pansilu Lakshan","P Lakshan","1994-11-10","19948047730","11/C, Yatiyanawatha, Mathara","stu_9.jpg","2020-08-08 06:44:24","3");



CREATE TABLE `subject_master` (
  `status` int(1) NOT NULL,
  `subject_key` int(11) NOT NULL AUTO_INCREMENT,
  `course_key` int(11) NOT NULL,
  `year_key` int(11) NOT NULL,
  `subject_name` varchar(300) NOT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`subject_key`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

INSERT INTO subject_master VALUES("0","1","1","1","Fundamental in Computing","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","2","1","1","Personnal Computer Application","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","3","1","1","Graphic Design","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","4","1","2","Principle of Software Engineering","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","5","1","2","Algoritham","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","6","1","2","Statictic","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","7","1","3","Data Structure","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","8","1","3","Communication Skill","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","9","1","3","Android Development","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","10","1","4","Database Management","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","11","1","4","VB.NET","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","12","1","4","PHP Programming","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","13","1","5","Artificial Intelligance","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","14","1","5","Rapid Application Development","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","15","1","5","Professional of IT","2020-03-13 08:57:44","0");
INSERT INTO subject_master VALUES("0","16","4","1","DEVELOP BASIC SOFTWARE SOLUTION","2020-03-13 14:56:16","3");
INSERT INTO subject_master VALUES("0","17","4","1","PERFORM WORD PROCESSING","2020-03-13 14:56:36","3");
INSERT INTO subject_master VALUES("0","18","4","1","PERFORM SPREADSHEET","2020-03-13 14:56:51","3");
INSERT INTO subject_master VALUES("0","19","4","1","PERFORM PRESENTATIONS","2020-03-13 14:57:02","3");
INSERT INTO subject_master VALUES("0","20","4","1","MAINTAIN DATABASES","2020-03-13 14:57:14","3");
INSERT INTO subject_master VALUES("0","21","4","2","PERFORM INTERNET AND ELECTRONIC MAIL OPERATORS","2020-03-13 14:58:02","3");
INSERT INTO subject_master VALUES("0","22","4","2","INSTALL AND CONFIGURE OPERATION SYSTEM","2020-03-13 14:58:17","3");
INSERT INTO subject_master VALUES("0","23","4","2","CONDUCT INSTALLATION AND TROUBLING SHOOTING OF NETWORK FROM CLIENT PC","2020-03-13 14:58:31","3");
INSERT INTO subject_master VALUES("0","24","4","2","DEVELOP GRAPHICS FOR WEB/ PRINT MEDIA","2020-03-13 14:58:44","3");
INSERT INTO subject_master VALUES("0","25","4","2","DESIGN AND DEVELOP STATIC WEB PAGES","2020-03-13 14:58:56","3");
INSERT INTO subject_master VALUES("0","26","4","2","DEVELOP BASIC SOFTWARE SOLUTION","2020-03-13 14:59:06","3");
INSERT INTO subject_master VALUES("0","27","7","1","MS Word Procecing ","2020-04-29 04:10:01","3");
INSERT INTO subject_master VALUES("0","28","7","1","Computer Baseic ","2020-04-29 04:10:33","3");
INSERT INTO subject_master VALUES("1","29","8","1","Disign Principlels ","2020-07-01 00:18:11","3");
INSERT INTO subject_master VALUES("1","30","8","1","Creativity","2020-07-01 00:18:24","3");
INSERT INTO subject_master VALUES("0","31","8","1","Developed concepts and sketches","2020-07-01 00:19:58","3");
INSERT INTO subject_master VALUES("0","32","8","1","Design and create graphics for print priducts","2020-07-01 00:20:50","3");
INSERT INTO subject_master VALUES("0","33","8","1","Design and create graphics for web interface","2020-07-01 00:21:18","3");
INSERT INTO subject_master VALUES("0","34","8","1","Conduct interpersonal communication ","2020-07-01 00:21:46","3");
INSERT INTO subject_master VALUES("0","35","12","1","Prepare financial statements of body corporate","2020-08-07 23:49:03","3");
INSERT INTO subject_master VALUES("0","36","12","1","Manage stock verification ","2020-08-07 23:49:18","3");
INSERT INTO subject_master VALUES("0","37","12","1","Prepare management information reports ","2020-08-07 23:49:36","3");
INSERT INTO subject_master VALUES("0","38","12","1","Perform cost statements","2020-08-07 23:50:00","3");
INSERT INTO subject_master VALUES("0","39","12","1","Submit information for short term decisions ","2020-08-07 23:50:11","3");
INSERT INTO subject_master VALUES("0","40","12","1","Manage Workplace Information","2020-08-07 23:50:34","3");
INSERT INTO subject_master VALUES("0","41","12","1","Plan Work to be performed in the Workplace ","2020-08-07 23:50:52","3");
INSERT INTO subject_master VALUES("0","42","12","2","Provide leadership& facilitate work teams ","2020-08-07 23:51:40","3");
INSERT INTO subject_master VALUES("0","43","12","2","Prepare investment appraisal report  ","2020-08-07 23:51:55","3");
INSERT INTO subject_master VALUES("0","44","12","2","Develop and implement internal control proces","2020-08-07 23:52:03","3");
INSERT INTO subject_master VALUES("0","45","12","2","Consolidate of financial statements  ","2020-08-07 23:52:22","3");
INSERT INTO subject_master VALUES("0","46","12","2","Plan and control audit  ","2020-08-07 23:52:41","3");
INSERT INTO subject_master VALUES("0","47","12","2","Interpret financial statements ","2020-08-07 23:52:57","3");
INSERT INTO subject_master VALUES("0","48","12","2","Authorize transactions ","2020-08-07 23:53:16","3");
INSERT INTO subject_master VALUES("0","49","14","1","Developed concepts and sketches ","2020-08-08 05:29:04","3");
INSERT INTO subject_master VALUES("0","50","14","1","Design and create graphics for print products ","2020-08-08 05:29:24","3");
INSERT INTO subject_master VALUES("0","51","14","1","Design and create graphics for web interfaces ","2020-08-08 05:29:40","3");
INSERT INTO subject_master VALUES("0","52","14","1","Conduct interpersonal communication","2020-08-08 05:29:55","3");



CREATE TABLE `timetable_details` (
  `status` int(1) NOT NULL,
  `timetable_key` int(11) NOT NULL AUTO_INCREMENT,
  `curstatusofbatch_key` int(11) NOT NULL,
  `lecture_key` int(11) NOT NULL,
  `dayos` varchar(30) NOT NULL,
  `timess` varchar(30) NOT NULL,
  `sys_enterdte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_person` int(11) NOT NULL,
  PRIMARY KEY (`timetable_key`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

INSERT INTO timetable_details VALUES("1","5","5","1","Monday","8.30AM to 9.30AM","2020-04-08 19:25:21","3");
INSERT INTO timetable_details VALUES("1","6","5","2","Monday","9.30AM to 10.30AM","2020-04-08 19:25:21","3");
INSERT INTO timetable_details VALUES("0","7","5","3","Monday","10.30AM to 11.30AM","2020-04-08 19:25:21","3");
INSERT INTO timetable_details VALUES("0","8","5","4","Monday","11.30AM to 12.30PM","2020-04-08 19:25:21","3");
INSERT INTO timetable_details VALUES("0","9","5","1","Monday","8.30AM to 9.30AM","2020-04-08 19:28:51","3");
INSERT INTO timetable_details VALUES("0","10","5","2","Monday","9.30AM to 10.30AM","2020-04-08 19:28:51","3");
INSERT INTO timetable_details VALUES("0","11","5","1","Sunday","3.00PM to 4.00PM","2020-04-08 19:29:00","3");
INSERT INTO timetable_details VALUES("0","12","4","1","Monday","9.30AM to 10.30AM","2020-04-11 19:25:36","3");
INSERT INTO timetable_details VALUES("0","13","4","1","Wednesday","9.30AM to 10.30AM","2020-04-11 19:25:36","3");
INSERT INTO timetable_details VALUES("0","14","4","1","Thursday","10.30AM to 11.30AM","2020-04-11 19:25:36","3");
INSERT INTO timetable_details VALUES("0","15","5","1","Monday","2.00PM to 3.00PM","2020-04-11 19:28:46","3");
INSERT INTO timetable_details VALUES("0","16","5","1","Tuesday","11.30AM to 12.30PM","2020-04-11 19:28:46","3");
INSERT INTO timetable_details VALUES("0","17","5","1","Wednesday","1.00PM to 2.00PM","2020-04-11 19:28:46","3");
INSERT INTO timetable_details VALUES("0","18","5","1","Sunday","9.30AM to 10.30AM","2020-04-11 19:28:46","3");
INSERT INTO timetable_details VALUES("0","19","5","1","Sunday","10.30AM to 11.30AM","2020-04-11 19:28:47","3");
INSERT INTO timetable_details VALUES("0","20","5","1","Sunday","11.30AM to 12.30PM","2020-04-11 19:28:47","3");
INSERT INTO timetable_details VALUES("0","21","8","12","Monday","8.30AM to 9.30AM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","22","8","12","Monday","9.30AM to 10.30AM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","23","8","12","Monday","10.30AM to 11.30AM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","24","8","12","Monday","11.30AM to 12.30PM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","25","8","12","Monday","1.00PM to 2.00PM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","26","8","12","Monday","2.00PM to 3.00PM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","27","8","12","Monday","3.00PM to 4.00PM","2020-07-01 00:27:36","3");
INSERT INTO timetable_details VALUES("0","28","8","12","Tuesday","8.30AM to 9.30AM","2020-07-01 00:30:40","3");
INSERT INTO timetable_details VALUES("0","29","8","12","Tuesday","9.30AM to 10.30AM","2020-07-01 00:30:40","3");
INSERT INTO timetable_details VALUES("0","30","8","12","Tuesday","10.30AM to 11.30AM","2020-07-01 00:30:40","3");
INSERT INTO timetable_details VALUES("0","31","8","12","Tuesday","11.30AM to 12.30PM","2020-07-01 00:30:40","3");
INSERT INTO timetable_details VALUES("0","32","8","13","Tuesday","1.00PM to 2.00PM","2020-07-01 00:30:40","3");
INSERT INTO timetable_details VALUES("0","33","8","13","Tuesday","2.00PM to 3.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","34","8","13","Tuesday","3.00PM to 4.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","35","8","13","Wednesday","8.30AM to 9.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","36","8","13","Wednesday","9.30AM to 10.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","37","8","13","Wednesday","10.30AM to 11.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","38","8","13","Wednesday","11.30AM to 12.30PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","39","8","13","Wednesday","1.00PM to 2.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","40","8","13","Wednesday","2.00PM to 3.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","41","8","13","Wednesday","3.00PM to 4.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","42","8","13","Thursday","8.30AM to 9.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","43","8","13","Thursday","9.30AM to 10.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","44","8","13","Thursday","10.30AM to 11.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","45","8","12","Thursday","11.30AM to 12.30PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","46","8","12","Thursday","1.00PM to 2.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","47","8","12","Thursday","2.00PM to 3.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","48","8","12","Thursday","3.00PM to 4.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","49","8","12","Friday","8.30AM to 9.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","50","8","12","Friday","9.30AM to 10.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","51","8","12","Friday","10.30AM to 11.30AM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","52","8","12","Friday","11.30AM to 12.30PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","53","8","12","Friday","1.00PM to 2.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","54","8","12","Friday","2.00PM to 3.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","55","8","12","Friday","3.00PM to 4.00PM","2020-07-01 00:30:41","3");
INSERT INTO timetable_details VALUES("0","56","11","12","Monday","8.30AM to 9.30AM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","57","11","12","Monday","9.30AM to 10.30AM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","58","11","12","Monday","10.30AM to 11.30AM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","59","11","12","Monday","11.30AM to 12.30PM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","60","11","12","Monday","1.00PM to 2.00PM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","61","11","12","Monday","2.00PM to 3.00PM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","62","11","12","Monday","3.00PM to 4.00PM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","63","11","12","Monday","4.00PM to 5.00PM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","64","11","9","Tuesday","8.30AM to 9.30AM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","65","11","9","Tuesday","9.30AM to 10.30AM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","66","11","9","Tuesday","10.30AM to 11.30AM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","67","11","9","Tuesday","11.30AM to 12.30PM","2020-08-08 05:47:09","3");
INSERT INTO timetable_details VALUES("0","68","11","12","Tuesday","1.00PM to 2.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","69","11","12","Tuesday","2.00PM to 3.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","70","11","12","Tuesday","3.00PM to 4.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","71","11","9","Wednesday","8.30AM to 9.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","72","11","9","Wednesday","9.30AM to 10.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","73","11","9","Wednesday","10.30AM to 11.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","74","11","9","Wednesday","11.30AM to 12.30PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","75","11","9","Wednesday","1.00PM to 2.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","76","11","9","Wednesday","2.00PM to 3.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","77","11","9","Wednesday","3.00PM to 4.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","78","11","19","Thursday","8.30AM to 9.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","79","11","19","Thursday","9.30AM to 10.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","80","11","19","Thursday","10.30AM to 11.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","81","11","19","Thursday","11.30AM to 12.30PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","82","11","12","Thursday","1.00PM to 2.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","83","11","12","Thursday","2.00PM to 3.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","84","11","12","Thursday","3.00PM to 4.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","85","11","12","Friday","8.30AM to 9.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","86","11","12","Friday","9.30AM to 10.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","87","11","12","Friday","10.30AM to 11.30AM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","88","11","12","Friday","11.30AM to 12.30PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","89","11","9","Friday","1.00PM to 2.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","90","11","9","Friday","2.00PM to 3.00PM","2020-08-08 05:47:10","3");
INSERT INTO timetable_details VALUES("0","91","11","9","Friday","3.00PM to 4.00PM","2020-08-08 05:47:10","3");



CREATE TABLE `user_master` (
  `status` int(11) NOT NULL,
  `user_key` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullnme` varchar(200) NOT NULL,
  `user_nme` varchar(10) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_level` varchar(50) NOT NULL,
  `lec_key` int(11) DEFAULT NULL,
  `sys_regdte` date NOT NULL,
  PRIMARY KEY (`user_key`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

INSERT INTO user_master VALUES("0","3","Ssd Ard Lahiru Smaraweera","la","202cb962ac59075b964b07152d234b70","admin","0","2020-02-06");
INSERT INTO user_master VALUES("1","5","Lahiru Chathuranga","la1","202cb962ac59075b964b07152d234b70","lec","1","2020-03-12");
INSERT INTO user_master VALUES("1","6","Gdd Sdd Amila Darshana","amila","8af95fe2ab1a54b488ef8efb3f3b0797","lec","2","2020-03-15");
INSERT INTO user_master VALUES("1","7","Kas Hiranthi perera","perera","8af95fe2ab1a54b488ef8efb3f3b0797","lec","3","2020-03-15");
INSERT INTO user_master VALUES("1","8","Gjdk Sdfg Vijith Susantha","susantha","8af95fe2ab1a54b488ef8efb3f3b0797","lec","4","2020-03-15");
INSERT INTO user_master VALUES("1","9","ssd Sss Kasun","kasun","8af95fe2ab1a54b488ef8efb3f3b0797","lec","5","2020-04-04");
INSERT INTO user_master VALUES("1","10","jshd sdj Saman","saman1","8af95fe2ab1a54b488ef8efb3f3b0797","lec","6","2020-04-04");
INSERT INTO user_master VALUES("0","11","sadf","sda12","8af95fe2ab1a54b488ef8efb3f3b0797","admin","0","2020-04-04");
INSERT INTO user_master VALUES("1","12","s","sSS","8af95fe2ab1a54b488ef8efb3f3b0797","lec","7","2020-05-03");
INSERT INTO user_master VALUES("0","13","Nilmini","NilMini","8af95fe2ab1a54b488ef8efb3f3b0797","admin","0","2020-05-23");
INSERT INTO user_master VALUES("1","14","sdsd","asd","8af95fe2ab1a54b488ef8efb3f3b0797","lec","8","2020-05-23");
INSERT INTO user_master VALUES("0","15","neel","neel","8af95fe2ab1a54b488ef8efb3f3b0797","admin","0","2020-06-20");
INSERT INTO user_master VALUES("0","16","Keembiya Liyanagamage Rashika Damayanthi","KLG","8af95fe2ab1a54b488ef8efb3f3b0797","lec","9","2020-06-30");
INSERT INTO user_master VALUES("1","17","asd","vxz","8af95fe2ab1a54b488ef8efb3f3b0797","lec","10","2020-06-30");
INSERT INTO user_master VALUES("1","18","a","a","8af95fe2ab1a54b488ef8efb3f3b0797","lec","11","2020-06-30");
INSERT INTO user_master VALUES("0","19","Saheli Ranasinghe ","SR1","46e730427f69082e83c7224521a5f5ea","lec","12","2020-07-01");
INSERT INTO user_master VALUES("0","20","Ishankha Sandya Kumari Weerasekara","ISKW","8af95fe2ab1a54b488ef8efb3f3b0797","lec","13","2020-07-01");
INSERT INTO user_master VALUES("0","21","Darshika Weerasigha ","AdminDW","8af95fe2ab1a54b488ef8efb3f3b0797","admin","0","2020-07-01");
INSERT INTO user_master VALUES("0","22","Darshika Weerasigha","AdminNW","8af95fe2ab1a54b488ef8efb3f3b0797","admin","0","2020-07-01");
INSERT INTO user_master VALUES("1","23","jj","jj","8af95fe2ab1a54b488ef8efb3f3b0797","lec","14","2020-07-01");
INSERT INTO user_master VALUES("1","24","jn","kk","8af95fe2ab1a54b488ef8efb3f3b0797","lec","15","2020-08-03");
INSERT INTO user_master VALUES("0","25","Kalani Anjana","Kalani","5b2ac06c6028d7dcb055cfef048870e4","admin","0","2020-08-07");
INSERT INTO user_master VALUES("1","26","Randika Lakshan","KPR","8af95fe2ab1a54b488ef8efb3f3b0797","lec","16","2020-08-07");
INSERT INTO user_master VALUES("0","27","Kelum Indika ","KI","8af95fe2ab1a54b488ef8efb3f3b0797","lec","17","2020-08-08");
INSERT INTO user_master VALUES("0","28","Kaluthantri Arachchige Lional ","KAL","8af95fe2ab1a54b488ef8efb3f3b0797","lec","18","2020-08-08");
INSERT INTO user_master VALUES("0","29","Sunil Rathnjith Weerakoon","SRW","8af95fe2ab1a54b488ef8efb3f3b0797","lec","19","2020-08-08");
INSERT INTO user_master VALUES("0","30","Hasitha Abewardhana ","HA1","8af95fe2ab1a54b488ef8efb3f3b0797","lec","20","2020-08-09");
INSERT INTO user_master VALUES("0","31","Mahinda Gamage","MG1","8af95fe2ab1a54b488ef8efb3f3b0797","lec","21","2020-08-09");



CREATE TABLE `year_master` (
  `status` int(1) NOT NULL,
  `year_key` int(11) NOT NULL AUTO_INCREMENT,
  `year_nme` varchar(50) NOT NULL,
  PRIMARY KEY (`year_key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO year_master VALUES("0","1","1st Year 1st Semester");
INSERT INTO year_master VALUES("0","2","1st Year 2nd Semester");
INSERT INTO year_master VALUES("0","3","2nd Year 1st Semester");
INSERT INTO year_master VALUES("0","4","2nd Year 2nd Semester");
INSERT INTO year_master VALUES("0","5","3rd Year 1st Semester");
INSERT INTO year_master VALUES("0","6","3rd Year 2nd Semester");
INSERT INTO year_master VALUES("0","7","4th Year 1st Semester");
INSERT INTO year_master VALUES("0","8","4th Year 2nd Semester");

