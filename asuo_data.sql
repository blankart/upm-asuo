INSERT INTO `studentaccount` (`student_id`, `up_id`, `up_mail`, `username`, `password`, `isVerified`, `isActivated`, `archived`) VALUES
(1, '201412345', 'anayos@up.edu.ph', 'anayos', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 1),
(2, '201364909', 'mrfernando@up.edu.ph', 'mrfernando', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 0),
(3, '201470124', 'mjgalvez@up.edu.ph', 'mjgalvez', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 0),
(4, '201481207', 'acracusa@up.edu.ph', 'acracusa', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 0),
(5, '201411235', 'kacolumna@up.edu.ph', 'kacolumna', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 0, 1),
(6, '201408109', 'pslasmarias@up.edu.ph', 'pslasmarias', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 0),
(7, '201479241', 'ncmendoza11@up.edu.ph', 'ncmendoza11', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 0, 0),
(8, '201499764', 'dgperez@up.edu.ph', 'dgperez', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 0),
(9, '201480756', 'avsanguenza@up.edu.ph', 'avsanguenza', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 0, 0, 0),
(10, '201480768', 'aleinstein@up.edu.ph', 'aleinstein', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 1, 1, 0);

INSERT INTO `studentprofile` (`student_id`, `first_name`, `middle_name`, `last_name`, `sex`, `birthday`, `course`, `year_level`, `contact_num`, `address`, `profile_pic`, `form5`) VALUES
(1, 'Angelica', 'Valderrama', 'Ayos', 'Female', '1997-01-01', 'BS Computer Science', '3rd Year', '09453291650', 'Cavite', '4E59E1F6DF867919DF4F14C26E668A0E.jpg', '61A2E7862DF10CE9C90EFA2DEAFD09A3.jpg'),
(2, 'Medy Rae', 'Jordan', 'Fernando', 'Male', '1997-04-11', 'BS Computer Science', '5th Year', '09453291650', 'Antique', '4EF5AE3715C869990D0B16E569A41CDA.jpg', 'FCEAAB139C506668D2F4B0527534772C.jpg'),
(3, 'Ma Christina', 'Jaranilla', 'Galvez', 'Female', '1997-01-01', 'BS Computer Science', '1st Year', '09453291650', 'Manila', '7A55083C2968B52AAEF206D2037B0994.jpg', '019775DC78BFDD9AD284F76348C319C0.jpg'),
(4, 'Aldrin', 'Cardano', 'Racusa', 'Male', '1997-01-01', 'BS Computer Science', '2nd Year', '09453291650', 'Rizal', '7B5A170F34DABFDF3A82C19180AE7523.jpg', '6687DC1DD6993BD33BBA287A155D2127.jpg'),
(5, 'Kylle Audrey', 'Andrea', 'Columna', 'Female', '1997-04-11', 'BS Computer Science', 'Doctoral', '09453291650', 'Manila', '106829DFF1C7FF25C6D7136DBDE2D535.jpg', 'F8D5659A9E4759BDF743C65593163FA4.jpg'),
(6, 'Paula Nicole', 'Salaysay', 'Lasmarias', 'Female', '1997-01-01', 'BS Computer Science', '7th Year', '09453291650', 'Davao', 'F98866AC4E20BE657348E3AFAC8F7AF3.jpg', '8EC980E4D2B09FBC9EB8BA71DFBFCFB1.jpg'),
(7, 'Nico', 'Cruel', 'Mendoza', 'Male', '1997-01-01', 'BS Computer Science', 'Masteral', '09453291650', 'Mindoro', '90778AA590D6BE9DB3B421A88982C7A1.jpg', '9BFC0678EF023B528DEE6A1ADDF91CCD.jpg'),
(8, 'Darlene Grace', 'Quimbo', 'Perez', 'Female', '1997-01-01', 'BS Computer Science', 'Doctoral', '09453291650', 'Manila', 'DAEDF7C9EBF74EB1667CE14C3726A550.jpg', 'DF08EAEB049D92E61E9E471D659C38C9.jpg'),
(9, 'Alyssa Fatima', 'Villaflores', 'Sanguenza', 'Female', '1997-01-01', 'BS Computer Science', '6th Year', '09453291650', 'Bulacan', '618210804B2BF13D1D7A38B16CE815A7.jpg', 'C7C38AF2AD324BA7CFCD3FDC77B13C24.jpg'),
(10, 'Albert', 'Hans', 'Einstein', 'Male', '1879-03-14', 'BS Computer Science', 'Doctoral', '09453291650', 'Under the Sea', 'BF8E91BA73CA6CAB9E41FD1931793031.jpg', 'D204F53E427E51F8FC1D3D8884BEB161.jpg');

INSERT INTO `admin` (`admin_id`, `username`, `password`, `admin_name`, `admin_email`) VALUES
(1, 'OSA', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Office of Student Affairs', 'admin@up.edu.ph'),
(2, 'USC', '$2y$10$O0bATKLUoYY9BmAGhAnbIOb/7halb57Vp8535bbm6JGnKbqUFv1O2', 'University Student Council', 'usc@up.edu.ph');

INSERT INTO `organizationaccount` (`org_id`, `org_email`, `password`, `org_status`, `isVerified`, `isActivated`, `archived`) VALUES
(1, 'aisec@gmail.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 1,  1),
(2, 'upmchorale@yahoo.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 1,  0),
(3, 'gabriela@gmail.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 1,  0),
(4, 'morg@yahoo.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 1,  0),
(5, 'upbeau@gmail.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 0,  1),
(6, 'upsocomsci@yahoo.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Accredited', 1, 1, 0),
(7, 'orcomsoc@gmail.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 0, 0),
(8, 'upvector@gmail.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 1, 0),
(9, 'orgasm@yahoo.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 0, 0, 0),
(10, 'upmkule@gmail.com', '$2y$10$QxbWa5UHQjgTq1UAjgmVjOVY.pHstNSIxK31IyNXJvg1sTnbTLSQ.', 'Unaccredited', 1, 1, 0);

INSERT INTO `organizationprofile` (`org_id`, `org_name`, `acronym`, `org_category`, `org_college`, `description`, `objectives`, `org_website`, `mailing_address`, `date_established`, `org_logo`, `constitution`, `incSEC`, `sec_years`) VALUES
(1, 'AISEC', 'AISEC', 'Socio-Civic', 'College of Arts and Sciences', 'AIESEC is a global platform for young people to explore and develop their leadership potential. We are a non-political, independent, not-for-profit organisation run by students and recent graduates of institutions of higher education. Its members are interested in world issues, leadership and management. AIESEC does not discriminate on the basis of ethnicity, gender, sexual orientation, religion or national/social origin.Since we were founded, we have engaged and developed over 1,000,000 young people who have been through an AIESEC experience. The impact of our organisation can be seen through our alumni who represent business, NGO and world leaders, including one Nobel Peace Prize laureate, Martti Ahtisaari of Finland.', 'AIESEC is a global network of people that simply believe that youth leadership is not an option, but our responsibility.', 'www.aiesec.org', 'University of the Philippines - Manila', '1948', 'fde3d4614bf1c82bc47b252875ef97b2.jpg', 'No uploads yet', 1, 6),
(2, 'UP Manila Chorale', 'UPM Chorale', 'Special Interest', 'College of  Arts and Sciences', 'The UP Manila Chorale is the official choir of the University of the Philippines – Manila, composed mainly of UP Manila students from various academic backgrounds with a shared love for singing.', 'Its aim is to produce excellent performances in order to uplift Filipino music and culture through choral music.', 'www.upmchorale.wix.com/up-manila-chorale', 'University of the Philippines - Manila', 'August 1992', '6b369cd1e3e73f289186ba31c943c43c.jpg', 'No uploads yet', 0, 0),
(3, 'Garbriela Youth', 'UPM Gabriela', 'Cause-Oriented', 'College of  Arts and Sciences', "GABRIELA Youth is a national organization of women students from various colleges and universities. Founded in 1994, the organization is the youth arm of GABRIELA, national alliance of women's organizations in the Philippines. With the aim of instilling awareness among students on women's rights and their significant role in the nation's struggle for genuine freedom and democracy.", "GABRIELA Youth launches campaigns and other activities to uphold the democratic rights of women in and outside the campus. It calls on students, women in particular, to go beyond the confines of their classrooms and claim their place in the Filipino women's struggle for liberation.", "www.gabrielawomensparty.net", '#35 Scout Delgado St., Bgy. Laging Handa, Quezon City, Philippines', '1990', '391ea5faffe2ecee779e82cbfc58a058.jpg', 'No uploads yet', 1, 3),
(4, 'UP Manila Musical Organization', 'UPMorg', 'Special Interest', 'College of  Arts and Sciences', 'org of music', 'to something', 'upmorg.com', 'University of the Philippines - Manila', '1991', 'a765743b36d83a8681cd018ac0edb17f.jpg', 'No uploads yet', 1, 4),
(5, 'UP Beau', 'UPB', 'Sorority', 'College of  Arts and Sciences', 'N/A', 'N/A', 'upbeau.com', 'University of the Philippines - Manila', 'N/A', '087ddd17c41558a3a29ae44b5bba8016.jpg', 'No uploads yet', 0, 0),
(6, 'UP Society of Computer Scientists', 'UP SoComSci', 'Academic', 'College of  Arts and Sciences', 'SoComSci is a non-profit, non-stock, non-political organization that hopes to promote greater awareness in computer technology and its wider application.', 'Beneficial to the Filipino community, SoComSci offers talks, tutorials, workshops and seminars, UPM Halalan Tech Team, and more.', 'www.agila.upm.edu.ph/~socomsci', 'University of the Philippines - Manila', '1993', 'c31944ef461eb828d715940a0f3b8cab.jpg', '39D4602FC8BB93E619B33D0213724720.pdf', 1, 5),
(7, 'Organizational Communications Society', 'OrComSoc', 'Academic', 'College of  Arts and Sciences', 'N/A', 'N/A', 'uporcomsoc.com', 'University of the Philippines - Manila', 'N/A', '3fc1026fb5f2f3665e2dd2029907cbb4.jpg', 'No uploads yet', 0,0 ),
(8, 'UP Vector', 'UP Vector', 'Academic', 'College of  Arts and Sciences', "The batch 2011 first year Applied Physics (Health Physics) students were the founding members of the UP Vector. It was originally called Medically Oriented Physicists Society. The term 'Vector' was suggested and was later adopted by the whole organization to suit the organization's mission and vision.", 'We aim to defy great magnitudes and lead the right direction!', 'upvector.com', 'University of the Philippines - Manila', '2011', '4cb09dcfea87b60898b8f86d9d99f149.jpg', 'No uploads yet', 0, 0),
(9, 'Organization of Area Studies Majors', 'OrgASM', 'Academic', 'College of  Arts and Sciences', 'N/A', 'N/A', 'orgasm.com', 'University of the Philippines - Manila', 'N/A', '33de90baee9dfac8afad381a9a679782.jpg', 'No uploads yet', 0, 0),
(10, 'The Manila Collegian', 'MKule', 'Service', 'College of  Arts and Sciences', 'The Manila Collegian is the official student publication of University of the Philippines Manila.', 'The institution aims to defend the rights and promote the welfare of the students and the Filipino people through advocacy journalism.', 'ww.issuu.com/manilacollegian', '4th Floor Student Center, University of the Philippines Manila, Ermita, Manila', '1987', '589926869598978a956ab447804628a1.jpg', 'No uploads yet', 0, 0);

-- -------------------------------------------------------------------

INSERT INTO `announcement` (`notice_id`, `sender`, `title`, `content`,  `date_posted`, `archived`) VALUES
(1, 1,'Welcome Message', 'Welcome to the Accreditation for University-wide Orgs', '2018-04-21 10:32:48', 0),
(2, 2, 'Accreditation Guidelines', 'Below is a list of guidelines when accreditation period for AY 2018-2019 opens.\nThank you', '2018-04-24 15:23:18', 0),
(3, 1, 'Accreditation Period Now Open', "Organizations are now able to apply for accreditation. Please take note of the deadline set for this year's accreditation. \nThank you.", '2018-04-30 22:07:23', 0),
(4, 1, "Resubmit Form", "Please resubmit your Form B and Form F.\nThank you.", '2018-05-10 23:59:59', 0),
(5, 1, 'Accreditation Period Ended', 'Accreditation period for AY 2018-2019 has officially been closed.\nStay tuned for updates regarding your accreditation applications.\nThank you.', '2018-05-14 00:00:00', 0),
(6, 1, 'Accreditation Result', 'Listed below are the accredited orgs:\n1) UP Manila Chorale\n2) UP Manila Musical Organization\n3) UP Society of Computer Scientists\n\n -- Nothing follows -- ', '2018-05-21 13:00:11', 0);

-- -------------------------------------------------------------------

INSERT INTO `recipient` (`recipient_id`, `notice_id`, `org_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 6),
(6, 1, 8),
(7, 1, 10),
(8, 2, 1),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 6),
(13, 2, 8),
(14, 2, 10),
(15, 3, 1),
(16, 3, 2),
(17, 3, 3),
(18, 3, 4),
(19, 3, 6),
(20, 3, 8),
(21, 3, 10),
(22, 4, 1),
(23, 4, 2),
(24, 4, 4),
(25, 4, 10),
(26, 5, 1),
(27, 5, 2),
(28, 5, 3),
(29, 5, 4),
(30, 5, 6),
(31, 5, 8),
(32, 5, 10),
(33, 6, 1),
(34, 6, 2),
(35, 6, 3),
(36, 6, 4),
(37, 6, 6),
(38, 6, 8),
(39, 6, 10);

-- -------------------------------------------------------------------


INSERT INTO `academicyear` (`AY_id`, `year_start`, `year_end`) VALUES
(1, 2017, 2018)
;


INSERT INTO `accreditationapplication` (`app_id`, `AY_id`, `org_id`, `app_status`, `form_A`, `form_B`, `form_C`, `form_D`, `form_E`, `form_F`, `plans`) VALUES
(1, 1, 6, 'Accredited', 'E0DF1C144280F4E36E638DCF95CED92C.pdf', '6581085DAAFDB45D90322F986D96B670.pdf', 'FEE06AFE1E48B092C726EA711D3ABE73.pdf', '3B7501A8C9CDE3A7B1EA381057BADA10.pdf', '1DB1EA57A537AE0B81576B66E9277161.pdf', 'D2A02B6233821B11D388957DEA0FE989.pdf', 'EFDAEADEA97149177948B2685C2F162F.pdf')
;

INSERT INTO `accreditation` (`accreditation_id`, `AY_id`, `org_id`, `archived`) VALUES
(1, 1, 6, 0)
;

INSERT INTO `accreditation_period` (`period_id`, `AY_id`, `admin_id`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 1, '2017-04-11 00:00:00', '2017-05-11 00:00:00', 'Closed' )
;

-- -------------------------------------------------------------------------

INSERT INTO `orgpost` (`post_id`, `org_id`, `title`, `content`, `date_posted`, `privacy`, `archived`) VALUES
(1, 6, "Untitled", "Hey dad, look at me. Think back and talk to me. Did I grow up according to plan? And did you think I have wasted my time doing things I wanted to? And it hurts when you disapprove all along.", '2018-01-13 18:54:09', 'Public', 0),
(2, 6, "Speak Now", "I am not the kind of girl who should be rudely barging in on a white veil occasion. But you are not the kind of boy who should be marrying the wrong girl. I sneak in and see your friends and her snotty little family all dressed in pastel", '2018-01-31 09:45:11', 'Members', 0),
(3, 6, "Title 3", "This is content 3. This post is deleted. It should not be visible.", '2018-02-14 17:03:18', 'Officers', 1),
(4, 6, "4th Title", "This is content 4. This post is deleted. It should not be visible.", '2018-02-15 09:43:21', 'Members', 1),
(5, 6, "Sagastipean", "Sagastipean hortzaz gora, ah!\nBelarrak bizkarra guri,\n\nsagar lorak xuritan lehertu\ngau ederraren zauri,\n\nmizperalek bost hezur ditu\nbost pena nere bihotzak\n\nbost adarrek bost sagar lora, jir jir\nbost izar lotsak.\n\nKopla kanta, airia dantza\nzorion eta nahigabe\ngau giroa ederra da ta,\nama ez naiz logale.", '2018-02-17 16:47:04', 'Officers', 0),
(6, 6, "6 out of 6 Title", "This is content 6. This post is deleted. It should not be visible.", '2018-02-27 11:34:19', 'Public', 1),

(7, 6, "Chapter 1", "Once was Apollo\nNow a rat in the Lab’rinth\nSend help. And cronuts\n\n\nNo.\nI refuse to share this part of my story. It was the lowest, most humiliating,most awful week in my four-thousand-plus years of life. Tragedy. Disaster. Heartbreak. I will not tell you about it.\n\nWhy are you still here? Go away!", '2018-02-28 19:26:08', 'Public', 0),
(8, 1, "Caught in the Middle", "I was dreaming life away\nAll the while just going blind\nCan't see the forest for the trees\nBehind the lids of my own eyes\nNostalgia's cool, but it won't help me now\nA dream is good (don't wear it out) if you don't wear it out\nAnd I'm just a little bit caught in the middle\nI try to keep going but it's not that simple\nI think I'm a little bit caught in the middle\nGotta keep going or they'll call me a quitter\nYeah, I'm caught in the middle\nNo, I don't need no help\nI can sabotage me by myself\nI don't need no one else\nI can sabotage me by myself", '2018-03-02 04:45:32', 'Members', 0),
(9, 1, "Pool", "I'm underwater\nWith no air in my lungs\nMy eyes are open\nI'm done giving up\nYou are the wave\nI could never tame\nIf I survive\nI'll dive back in", '2018-03-14 15:29:26', 'Officers', 0),
(10, 1, "Tell Me How", "You keep me up with your silence\nTake me down with your quiet\nOf all the weapons you fight with\nYour silence is the most violent\nTell me how to feel about you now\nTell me how to feel about you now\nOh, let me know\nDo I suffocate or let go?", '2018-03-17 22:17:34', 'Members', 0),
(11, 3, "Spoiler | Ship of the Dead", "“I think this is awesome, Magnus,” she said on the phone from California. “You are amazing. I—I kind of needed some good news right now.”\nThat set my ears buzzing. Why did Annabeth sound like she’d been crying?\n“You okay, cuz?”\nShe paused for a long time. “I will be. We…we got some bad news when we got out here.”", '2018-4-11 07:11:07', 'Officers', 0),
(12, 3, "Hard Times", "Walking around\nWith my little rain cloud\nHanging over my head\nAnd it ain't coming down\nWhere do I go?\nGimme some sort of sign\nYou hit me with lightning!\nMaybe I'll come alive", '2018-04-19 05:31:36', 'Public', 0);

-- -------------------------------------------------------------------------

INSERT INTO `orgapplication` (`orgapp_id`, `org_id`, `student_id`, `status`) VALUES
(1, 6, 1, 'Approved'),
(2, 6, 2, 'Approved'),
(3, 6, 3, 'Approved'),
(4, 6, 4, 'Approved'),
(5, 8, 6, 'Approved'),
(6, 6, 6, 'Approved'),
(7, 4, 5, 'Approved'),
(8, 6, 8, 'Approved'),
(9, 3, 4, 'Approved'),

(10, 1, 10, 'Approved'),
(11, 2, 10, 'Pending'),
(12, 3, 10, 'Approved'),
(13, 4, 10, 'Approved'),
(14, 8, 10, 'Approved'),
(15, 6, 10, 'Pending'),
(16, 10, 10, 'Approved'),
(17, 6, 8, 'Pending');

-- -------------------------------------------------------------------------

INSERT INTO `orgmember` (`membership_id`, `org_id`, `student_id`, `position`, `isRemoved`, `removal_reason`) VALUES
(1, 6, 1, 'President', 0, 'Not removed'),
(2, 6, 2, 'Member', 0, 'Not removed'),
(3, 6, 3, 'Member', 0, 'Not removed'),
(4, 6, 4, 'Member', 1, 'Not cute enough XD'),
(5, 8, 6, 'Secretary', 0, 'Not removed'),
(6, 6, 6, 'Finance Officer', 0, 'Not removed'),
(7, 4, 5, 'Treasurer', 0, 'Not removed'),
(8, 6, 8, 'Member', 1, 'Kulang ng 3 paligo'),
(9, 3, 4, 'Auditor', 0, 'Not removed'),

(10, 1, 10, 'President', 0, 'Not removed'),
(11, 3, 10, 'Member', 0, 'Not removed'),
(12, 4, 10, 'Member', 1, 'Too school for cool'),
(13, 8, 10, 'Auditor', 0, 'Not removed'),
(14, 10, 10, 'Member', 0, 'Not removed');

-- ------------------------------------------------------------------------
INSERT INTO `login_notice` (`announcement_id`, `admin_id`, `title`, `content`, `date_posted`) VALUES
(1, 1, 'Welcome Message', "Walking around with my little rain cloud. Hanging over my head and it ain't coming down. Where do I go?\nGimme some sort of sign. You hit me with lightning! Maybe I'll come alive", '2018-05-22 23:00:00');

INSERT INTO `student_notice` (`announcement_id`, `admin_id`, `student_id`, `content`, `date_posted`) VALUES
(1, 1, 7, "Listed below are changes needed for your account to be activated:\n1)Student Number\n2)Name\n3)Address\n\nThank you.", '2018-05-22 23:00:00');

-- ------------------------------------------------------------------------

INSERT INTO `restrictedacronym` (`res_id`, `acronym`) VALUES
(1, 'login'),
(2, 'regstud'),
(3, 'regorg'),
(4, 'changeOrgPassword'),
(5, 'createPost'),
(6, 'editOrgProfile'),
(7, 'changeLogo'),
(8, 'admin'),
(9, 'uploadConstitution'),
(10, 'uploadFormB'),
(11, 'uploadFormF'),
(12, 'uploadFormG'),
(13, 'uploadPlans'),
(14, 'uploadAll'),
(15, 'applyToOrg'),
(16, 'rejectMembership'),
(17, 'approveMembership'),
(18, 'editMembershipPosition'),
(19, 'removeMember'),
(20, 'applyforaccreditation'),
(21, 'formA'),
(22, 'formB'),
(23, 'formC'),
(24, 'formD'),
(25, 'formE'),
(26, 'formF'),
(27, 'formG'),
(28, 'plans'),
(29, 'submitAll'),
(30, 'saveFormA'),
(31, 'viewFormA'),
(32, 'viewFormC'),
(33, 'viewFormD'),
(34, 'viewFormE'),
(35, 'viewFormF'),
(36, 'OSA'),
(36, 'USC');
