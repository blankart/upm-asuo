INSERT INTO `studentaccount` (`student_id`, `up_id`, `up_mail`, `username`, `password`, `isVerified`, `isActivated`, `archived`) VALUES
(1, '201412345', 'anayos@up.edu.ph', 'anayos', '32250170a0dca92d53ec9624f336ca24', 1, 1, 1),
(2, '201364909', 'mjfernando@up.edu.ph', 'mjfernando', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(3, '201470124', 'mjgalvez@up.edu.ph', 'mjgalvez', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(4, '201481207', 'acracusa@up.edu.ph', 'acracusa', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(5, '201411235', 'kacolumna@up.edu.ph', 'kacolumna', '32250170a0dca92d53ec9624f336ca24', 1, 0, 1),
(6, '201408109', 'pslasmarias@up.edu.ph', 'pslasmarias', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(7, '201479241', 'ncmendoza1@up.edu.ph', 'nmendoza', '32250170a0dca92d53ec9624f336ca24', 1, 0, 0),
(8, '201499764', 'dgperez@up.edu.ph', 'dgperez', '32250170a0dca92d53ec9624f336ca24', 1, 1, 0),
(9, '201480756', 'avsangeuenza@up.edu.ph', 'avsanguenza', '32250170a0dca92d53ec9624f336ca24', 1, 0, 0);

INSERT INTO `studentprofile` (`student_id`, `first_name`, `middle_name`, `last_name`, `sex`, `birthday`, `course`, `contact_num`, `profile_pic`, `year_level`) VALUES
(1, 'Angelica', 'A', 'Ayos', 'Female', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'angelica.jpg', 0),
(2, 'Medy Rae', 'Jordan', 'Fernando', 'Male', '1997-04-11', 'BS Computer Science', '09453291650', 'medy.jpg', 0),
(3, 'Ma Christina', 'J', 'Galvez', 'Female', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'christina.jpg', 0),
(4, 'Aldrin', 'C', 'Racusa', 'Male', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'aldrin.jpg', 0),
(5, 'Kylle Audrey', 'A', 'Columna', 'Female', '1997-04-11', 'BS Computer Science', '09XXXXXXXXX', 'kylle.jpg', 0),
(6, 'Paula Nicole', 'S', 'Lasmarias', 'Female', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'paula.jpg', 0),
(7, 'Nico', 'Cruelala', 'Mendoza', 'Male', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'nico.jpg', 0),
(8, 'Darlene Grace', 'A', 'Perez', 'Female', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'darlene.jpg', 0),
(9, 'Alyssa Fatima', 'V', 'Sanguenza', 'Female', '1997-01-01', 'BS Computer Science', '09XXXXXXXXX', 'alyssa.jpg', 0);

INSERT INTO `admin` (`username`, `password`, `admin_id`, `admin_email`) VALUES
('admin@up.edu.ph', '32250170a0dca92d53ec9624f336ca24', 1, 'admin@up.edu.ph');

INSERT INTO `organizationaccount` (`org_id`, `org_email`, `password`, `org_status`, `isVerified`, `isActivated`, `archived`) VALUES
(1, 'aisec@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 0, 0,  0),
(2, 'upmchorale@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Accredited', 1, 1,  0),
(3, 'gabriela@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 0,  0),
(4, 'morg@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 0,  0),
(5, 'upbeau@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Accredited', 1, 1,  0),
(6, 'upsocomsci@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Acredited', 1, 1, 0),
(7, 'orcomsoc@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 0, 0,  1),
(8, 'upvector@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 1,  0),
(9, 'orgasm@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 0,  1),
(10, 'upmkule@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'Unaccredited', 1, 1,  0);

INSERT INTO `organizationprofile` (`org_id`, `org_name`, `acronym`, `org_category`, `description`, `objectives`, `org_website`, `mailing_address`, `date_established`, `org_logo`) VALUES
(1, 'AISEC', 'AISEC', 'Socio-Civic', 'international involvement org', 'to something', 'aisec.com', 'here', '1988', 'aisec.jpg'),
(2, 'UP Manila Chorale', 'UPM Chorale', 'Special Interest', 'music org', 'to something', 'upmchorale.com', 'there', '1989', 'upmc.jpg'),
(3, 'Garbriela Youth', 'UPM Gabriela', 'Cause-Oriented', 'Women empowerment org', 'to something', 'gabriela.com', 'where', '1990', 'gabriela.jpg'),
(4, 'UP Manila Musical Organization', 'UPMorg', 'Special Interest', 'org of music', 'to something', 'upmorg.com', 'herewhere', '1991', 'upmorg.jpg'),
(5, 'UP Beau', 'UPB', 'Sorority', 'org of females', 'to something', 'upbeau.com', 'wherewhere', '1992', 'upbeau.jpg'),
(6, 'UP Society of Computer Scientists', 'UP SoComSci', 'Academic', 'org of computer enthusiasts', 'to something', 'upsocomsci.com', 'hello world', '1993', 'upsocomsci.jpg'),
(7, 'Organizational Communication Society', 'OrComSoc', 'Academic', 'org of orcom students', 'to something', 'uporcomsoc.com', 'therethere', '1993', 'uporcomsoc.jpg'),
(8, 'UP Vector', 'UP Vector', 'Academic', 'org of vectors', 'to something', 'upvector.com', 'somewhere', '1994', 'upvector.jpg'),
(9, 'Organization of Area Studies Majors', 'OrgASM', 'Academic', 'org of asm', 'to something', 'orgasm.com', 'over', '1995', 'orgasm.jpg'),
(10, 'UP Manila Collegian', 'MKule', 'Service', 'org of collegians XD', 'to something', 'mkule.com', 'my head', '1996', 'mkule.jpg');

-- -------------------------------------------------------------------

INSERT INTO `announcement` (`notice_ID`, `recipient`, `title`, `content`,  `date_posted`) VALUES
(1, 10,'Test Announcement', 'Hello. This is a test announcement. :D',  '2017-09-04'),
(2, 4, 'wala akong title :<', 'wala na akong maisip na ilalagay :((', '2018-03-28'),
(3, 3,'HAPPY BIRTHDAY ALDRIN!!!', 'BIRTHDAY NI ALDRIN XD',  '2018-04-15'),
(4, 9, 'Accredited ORganization', 'Listed below are the accredited orgs:\r\n.\r\n.\r\n.\r\n..\r\n.\r\n.\r\n.\r\n.\r\n.\r\n\r\n.\r\n', '2018-04-12'),
(5, 2, 'Welcome Message', 'Welcome to the Accreditation for University-wide Orgs',  '2018-03-02'),
(6, 5, 'Exam sa stat121', 'friday this week:<', '2018-04-13'),
(7, 8,'Accreditation Period', 'Accreditation period will start on ...',  '2018-04-04'),
(8, 1, 'General Assembly for Univ-wide Orgs', 'A general assembly will be conducted on ...',  '2017-12-12'),
(9, 6,'Orgs with pending accreditation app\r\n', 'Listed below are the orgs with pending application:\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n\r\n...\r\n.\r\n.\r\n\r\n\r\n.',  '2018-04-14'),
(10, 7,'Requirements for Accreditaitoin', 'Listed below are the requirements for accreditation:\r\n.\r\n.\r\n.', '2018-04-02'),
(11, 3, 'hey', 'hey',  '2018-04-15'),
(12, 0, 'This is Zero', 'sample message', '2018-04-15'),
(13, 3, 'Hey', 'Musta niggas',  '2018-04-15'),
(14, 3, 'something', 'something',  '2018-04-15'),
(15, 4, 'something', 'something',  '2018-04-15'),
(16, 5, 'something', 'something',  '2018-04-15'),
(17, 6, 'something', 'something', '2018-04-15'),
(18, 8, 'something', 'something',  '2018-04-15'),
(19, 9, 'something', 'something',  '2018-04-15'),
(20, 4, 'The quick brown fox jumps over the lazy dog', 'The quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps o',  '2018-04-16'),
(21, 4, 'jello', 'jello', '2018-04-16'),
(22, 4, 'sdasdasd', 'asdasdasd',  '2018-04-16'),
(23, 4, 'final something', 'final something',  '2018-04-16');

-- -------------------------------------------------------------------

INSERT INTO `accreditationapplication` (`app_id`, `org_id`, `form_A`) VALUES
(1, 6, 'This is form A'),
(2, 7, 'This is form A'),
(3, 8, 'This is form A');