INSERT INTO `studentaccount` (`student_id`, `up_id`, `up_mail`, `username`, `password`, `isVerified`, `isActivated`, `archived`) VALUES
(1, '201412345', 'anayos@up.edu.ph', 'anayos', '32250170a0dca92d53ec9624f336ca24', 1, 1, 1),
(2, '201364909', 'mrfernando@up.edu.ph', 'mrfernando', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(3, '201470124', 'mjgalvez@up.edu.ph', 'mjgalvez', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(4, '201481207', 'acracusa@up.edu.ph', 'acracusa', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(5, '201411235', 'kacolumna@up.edu.ph', 'kacolumna', '32250170a0dca92d53ec9624f336ca24', 1, 0, 1),
(6, '201408109', 'pslasmarias@up.edu.ph', 'pslasmarias', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(7, '201479241', 'ncmendoza11@up.edu.ph', 'ncmendoza1', '32250170a0dca92d53ec9624f336ca24', 1, 0, 0),
(8, '201499764', 'dgperez@up.edu.ph', 'dgperez', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(9, '201480756', 'avsanguenza@up.edu.ph', 'avsanguenza', '32250170a0dca92d53ec9624f336ca24', 0, 0, 0),
(10, '201480768', 'aleinstein@up.edu.ph', 'aleinstein', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0);

INSERT INTO `studentprofile` (`student_id`, `first_name`, `middle_name`, `last_name`, `sex`, `birthday`, `course`, `year_level`, `contact_num`, `address`, `profile_pic`, `form5`) VALUES
(1, 'Angelica', 'A', 'Ayos', 'Female', '1997-01-01', 'BS Computer Science', '3rd Year', '09XXXXXXXXX', 'Cavite', '4E59E1F6DF867919DF4F14C26E668A0E.jpg', '61A2E7862DF10CE9C90EFA2DEAFD09A3.jpg'),
(2, 'Medy Rae', 'Jordan', 'Fernando', 'Male', '1997-04-11', 'BS Computer Science', '5th Year', '09453291650', 'Antique', '4EF5AE3715C869990D0B16E569A41CDA.jpg', 'FCEAAB139C506668D2F4B0527534772C.jpg'),
(3, 'Ma Christina', 'J', 'Galvez', 'Female', '1997-01-01', 'BS Computer Science', '1st Year', '09XXXXXXXXX', 'Manila', '7A55083C2968B52AAEF206D2037B0994.jpg', '019775DC78BFDD9AD284F76348C319C0.jpg'),
(4, 'Aldrin', 'C', 'Racusa', 'Male', '1997-01-01', 'BS Computer Science', '2nd Year', '09XXXXXXXXX', 'Rizal', '7B5A170F34DABFDF3A82C19180AE7523.jpg', '6687DC1DD6993BD33BBA287A155D2127.jpg'),
(5, 'Kylle Audrey', 'A', 'Columna', 'Female', '1997-04-11', 'BS Computer Science', 'Doctoral', '09XXXXXXXXX', 'Manila', '106829DFF1C7FF25C6D7136DBDE2D535.jpg', 'F8D5659A9E4759BDF743C65593163FA4.jpg'),
(6, 'Paula Nicole', 'S', 'Lasmarias', 'Female', '1997-01-01', 'BS Computer Science', '7th Year', '09XXXXXXXXX', 'Davao', 'F98866AC4E20BE657348E3AFAC8F7AF3.jpg', '8EC980E4D2B09FBC9EB8BA71DFBFCFB1.jpg'),
(7, 'Nico', 'Cruelala', 'Mendoza', 'Male', '1997-01-01', 'BS Computer Science', 'Masteral', '09XXXXXXXXX', 'Mindoro', '90778AA590D6BE9DB3B421A88982C7A1.jpg', '9BFC0678EF023B528DEE6A1ADDF91CCD.jpg'),
(8, 'Darlene Grace', 'A', 'Perez', 'Female', '1997-01-01', 'BS Computer Science', 'Doctoral', '09XXXXXXXXX', 'Manila', 'DAEDF7C9EBF74EB1667CE14C3726A550.jpg', 'DF08EAEB049D92E61E9E471D659C38C9.jpg'),
(9, 'Alyssa Fatima', 'V', 'Sanguenza', 'Female', '1997-01-01', 'BS Computer Science', '6th Year', '09XXXXXXXXX', 'Bulacan', '618210804B2BF13D1D7A38B16CE815A7.jpg', 'C7C38AF2AD324BA7CFCD3FDC77B13C24.jpg'),
(10, 'Albert', 'Hans', 'Einstein', 'Male', '1879-03-14', 'BS Computer Science', 'Doctoral', '09XXXXXXXXX', 'Under the Sea', 'BF8E91BA73CA6CAB9E41FD1931793031.jpg', 'D204F53E427E51F8FC1D3D8884BEB161.jpg');

INSERT INTO `admin` (`admin_id`, `username`, `password`, `admin_name`, `admin_email`) VALUES
(1, 'OSA', '32250170a0dca92d53ec9624f336ca24', 'Office of Student Affairs', 'admin@up.edu.ph'),
(2, 'USC', '32250170a0dca92d53ec9624f336ca24', 'University Student Council', 'usc@up.edu.ph');

INSERT INTO `organizationaccount` (`org_id`, `org_email`, `password`, `org_status`, `isVerified`, `isActivated`, `archived`) VALUES
(1, 'aisec@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 0, 0,  0),
(2, 'upmchorale@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Accredited', 1, 1,  0),
(3, 'gabriela@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 0,  0),
(4, 'morg@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 0,  0),
(5, 'upbeau@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Accredited', 1, 1,  0),
(6, 'upsocomsci@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Accredited', 1, 1, 0),
(7, 'orcomsoc@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 0, 0,  1),
(8, 'upvector@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 0,  1),
(9, 'orgasm@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 1,  1),
(10, 'upmkule@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 0, 0,  0);

INSERT INTO `organizationprofile` (`org_id`, `org_name`, `acronym`, `org_category`, `org_college`, `description`, `objectives`, `org_website`, `mailing_address`, `date_established`, `org_logo`, `constitution`, `incSEC`, `sec_years`) VALUES
(1, 'AISEC', 'AISEC', 'Socio-Civic', 'College of Arts and Sciences', 'international involvement org', 'to something', 'aisec.com', 'here', '1988', '	
fde3d4614bf1c82bc47b252875ef97b2.jpg', 'No uploads yet', 0, 0),
(2, 'UP Manila Chorale', 'UPM Chorale', 'Special Interest', 'College of  Arts and Sciences', 'music org', 'to something', 'upmchorale.com', 'there', '1989', '6b369cd1e3e73f289186ba31c943c43c.jpg', 'No uploads yet', 0, 0),
(3, 'Garbriela Youth', 'UPM Gabriela', 'Cause-Oriented', 'College of  Arts and Sciences', 'Women empowerment org', 'to something', 'gabriela.com', 'where', '1990', '391ea5faffe2ecee779e82cbfc58a058.jpg', 'No uploads yet', 1, 3),
(4, 'UP Manila Musical Organization', 'UPMorg', 'Special Interest', 'College of  Arts and Sciences', 'org of music', 'to something', 'upmorg.com', 'herewhere', '1991', '	
a765743b36d83a8681cd018ac0edb17f.jpg', 'No uploads yet', 1, 4),
(5, 'UP Beau', 'UPB', 'Sorority', 'College of  Arts and Sciences', 'org of females', 'to something', 'upbeau.com', 'wherewhere', '1992', '087ddd17c41558a3a29ae44b5bba8016.jpg', 'No uploads yet', 0, 0),
(6, 'UP Society of Computer Scientists', 'UP SoComSci', 'Academic', 'College of  Arts and Sciences', 'org of computer enthusiasts', 'to something', 'upsocomsci.com', 'hello world', '1993', 'c31944ef461eb828d715940a0f3b8cab.jpg', '39D4602FC8BB93E619B33D0213724720.pdf', 1, 5),
(7, 'Organizational Communications Society', 'OrComSoc', 'Academic', 'College of  Arts and Sciences', 'org of orcom students', 'to something', 'uporcomsoc.com', 'therethere', '1993', '3fc1026fb5f2f3665e2dd2029907cbb4.jpg', 'No uploads yet', 0,0 ),
(8, 'UP Vector', 'UP Vector', 'Academic', 'College of  Arts and Sciences', 'org of vectors', 'to something', 'upvector.com', 'somewhere', '1994', '4cb09dcfea87b60898b8f86d9d99f149.jpg', 'No uploads yet', 0, 0),
(9, 'Organization of Area Studies Majors', 'OrgASM', 'Academic', 'College of  Arts and Sciences', 'org of asm', 'to something', 'orgasm.com', 'over', '1995', '33de90baee9dfac8afad381a9a679782.jpg', 'No uploads yet', 1, 6),
(10, 'UP Manila Collegian', 'MKule', 'Service', 'College of  Arts and Sciences', 'org of collegians XD', 'to something', 'mkule.com', 'my head', '1996', '589926869598978a956ab447804628a1.jpg', 'No uploads yet', 0, 0);

-- -------------------------------------------------------------------

INSERT INTO `announcement` (`notice_id`, `sender`, `title`, `content`,  `date_posted`, `archived`) VALUES
(1, 1,'Test Announcement', 'Hello. This is a test announcement. :D', '2018-01-04 13:23:48', 0),
(2, 1, 'wala akong title :<', 'wala na akong maisip na ilalagay :((', '2018-01-04 13:23:49', 0),
(3, 1, 'HAPPY BIRTHDAY ALDRIN!!!', 'BIRTHDAY NI ALDRIN XD', '2018-01-04 13:23:50', 0),
(4, 2, 'Accredited ORganization', 'Listed below are the accredited orgs:\r\n.\r\n.\r\n.\r\n..\r\n.\r\n.\r\n.\r\n.\r\n.\r\n\r\n.\r\n', '2018-01-04 13:23:51', 0),
(5, 1, 'Welcome Message', 'Welcome to the Accreditation for University-wide Orgs',  '2018-01-04 13:23:52', 0),
(6, 1, 'Exam sa stat121', 'friday this week:<', '2018-01-04 13:23:53', 0),
(7, 2, 'Accreditation Period', 'Accreditation period will start on ...',  '2018-01-04 13:23:54', 0),
(8, 1, 'General Assembly for Univ-wide Orgs', 'A general assembly will be conducted on ...',  '2018-01-04 13:23:55', 0),
(9, 1, 'Orgs with pending accreditation app\r\n', 'Listed below are the orgs with pending application:\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n\r\n...\r\n.\r\n.\r\n\r\n\r\n.', '2018-01-04 13:23:56', 0),
(10, 1, 'Requirements for Accreditaitoin', 'Listed below are the requirements for accreditation:\r\n.\r\n.\r\n.', '2018-01-04 13:23:57', 0),
(11, 1, 'hey', 'hey', '2018-01-04 13:23:58', 0),
(12, 2, 'This is Zero', 'sample message', '2018-01-04 13:23:59', 0),
(13, 1, 'Hey', 'Musta niggas',  '2018-01-04 13:24:48', 0),
(14, 1, 'something', 'something',  '2018-01-04 13:24:49', 0),
(15, 1, 'The quick brown fox jumps over the lazy dog', 'The quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps o', '2018-01-04 13:24:50', 0),
(16, 2, 'jello', 'jello', '2018-01-04 13:24:51', 0),
(17, 1, 'sdasdasd', 'asdasdasd', '2018-01-04 13:24:52', 0),
(18, 2, 'final something', 'final something', '2018-01-04 13:24:53', 0);


-- -------------------------------------------------------------------

INSERT INTO `recipient` (`recipient_id`, `notice_id`, `org_id`) VALUES
(1, 1, 10),
(2, 2, 4),
(3, 3, 3),
(4, 4, 9),
(5, 5, 2),
(6, 6, 5),
(7, 7, 8),
(8, 8, 1),
(9, 9, 6),
(10, 10, 7),
(11, 11, 3),
(12, 12, 1),
(13, 13, 3),
(14, 14, 3),
(15, 14, 4),
(16, 14, 5),
(17, 14, 6),
(18, 14, 8),
(19, 14, 9),
(20, 15, 4),
(21, 16, 4),
(22, 17, 4),
(23, 18, 4),
(24, 18, 5),
(25, 18, 6),
(26, 18, 7),
(27, 18, 8);

-- -------------------------------------------------------------------

INSERT INTO `accreditationapplication` (`app_id`, `org_id`, `app_status`, `form_A`, `form_B`, `form_C`, `form_D`, `form_E`, `form_F`, `plans`) VALUES
(1, 6, 'Pending', 'E0DF1C144280F4E36E638DCF95CED92C.pdf', '6581085DAAFDB45D90322F986D96B670.pdf', 'FEE06AFE1E48B092C726EA711D3ABE73.pdf', '3B7501A8C9CDE3A7B1EA381057BADA10.pdf', '1DB1EA57A537AE0B81576B66E9277161.pdf', 'D2A02B6233821B11D388957DEA0FE989.pdf', 'EFDAEADEA97149177948B2685C2F162F.pdf')
;


-- -------------------------------------------------------------------------

INSERT INTO `orgmember` (`membership_id`, `org_id`, `student_id`, `position`, `isRemoved`, `removal_reason`) VALUES
(1, 6, 1, 'President', 0, 'Not removed'),
(2, 6, 2, 'Member', 0, 'Not removed'),
(3, 6, 3, 'Member', 0, 'Not removed'),
(4, 6, 4, 'Member', 1, 'Not cute enough XD'),
(5, 6, 5, 'Secretary', 0, 'Not removed'),
(6, 6, 6, 'Finance Officer', 0, 'Not removed'),
(7, 6, 7, 'Treasurer', 0, 'Not removed'),
(8, 6, 8, 'Member', 1, 'Kulang ng 3 paligo'),
(9, 6, 9, 'Auditor', 0, 'Not removed'),

(10, 1, 10, 'President', 0, 'Not removed'),
(11, 3, 10, 'Member', 0, 'Not removed'),
(12, 4, 10, 'Member', 1, 'Too school for cool'),
(13, 9, 10, 'Auditor', 0, 'Not removed');

-- -------------------------------------------------------------------------

INSERT INTO `orgpost` (`post_id`, `org_id`, `title`, `content`, `date_posted`, `privacy`, `archived`) VALUES
(1, 6, "Untitled", "This is content 1", '2018-11-11 13:23:44', 'Public', 1),
(2, 6, "Title of 2", "This is content 2", '2018-11-11 13:23:45', 'Members', 0),
(3, 6, "Title 3", "This is content 3", '2018-11-11 13:23:46', 'Officers', 1),
(4, 6, "4th Title", "This is content 4", '2018-11-11 13:23:47', 'Members', 1),
(5, 6, "Title of 5th Post", "This is content 5", '2018-11-11 13:23:48', 'Officers', 0),
(6, 6, "6 out of 6 Title", "This is content 6", '2018-11-11 13:23:49', 'Public', 0),

(7, 1, "Untitled", "This is content 7", '2018-11-11 13:24:44', 'Public', 0),
(8, 1, "Title of 8", "This is content 8", '2018-11-11 13:25:45', 'Members', 0),
(9, 1, "Title 9", "This is content 9", '2018-11-11 13:26:46', 'Officers', 0),
(10, 3, "10th Title", "This is content 10", '2018-11-11 13:27:47', 'Members', 0),
(11, 3, "Title of 11th Post", "This is content 11", '2018-11-11 13:28:48', 'Officers', 0),
(12, 3, "12 out of 12 Title", "This is content 12", '2018-11-11 13:29:49', 'Public', 0);

-- -------------------------------------------------------------------------

INSERT INTO `orgapplication` (`orgapp_id`, `org_id`, `student_id`, `status`) VALUES
(1, 6, 1, 'Approved'),
(2, 6, 2, 'Approved'),
(3, 6, 3, 'Approved'),
(4, 6, 4, 'Rejected'),
(5, 6, 5, 'Approved'),
(6, 6, 6, 'Approved'),
(7, 6, 7, 'Approved'),
(8, 6, 8, 'Pending'),
(9, 6, 9, 'Approved'),

(10, 1, 10, 'Approved'),
(11, 2, 10, 'Pending'),
(12, 3, 10, 'Pending'),
(13, 4, 10, 'Approved'),
(14, 5, 10, 'Pending'),
(15, 6, 10, 'Pending'),
(16, 9, 10, 'Approved');

-- ------------------------------------------------------------------------

INSERT INTO `restrictedacronym` (`res_id`, `acronym`) VALUES
(1, 'login'),
(2, 'regstud'),
(3,'regorg'),
(4,'change_password'),
(5,'admin'),
(6,'OSA');
