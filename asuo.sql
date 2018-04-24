-- STUDENT
CREATE TABLE `studentaccount` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `up_id` char(9) NOT NULL,
  `up_mail` varchar(50) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `isActivated` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `studentprofile` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `birthday` date NOT NULL,
  `course` varchar(50) NOT NULL,
  `contact_num` varchar(11) NOT NULL,
  `profile_pic` varchar(150) NOT NULL DEFAULT 'img_default.jpg',
  `year_level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `studentaccount`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `up_id` (`up_id`),
  ADD UNIQUE KEY `up_mail` (`up_mail`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `studentaccount`
  MODIFY `student_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `studentprofile`
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `studentprofile`
  ADD CONSTRAINT `studentprofile_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `studentaccount` (`student_id`);

  -- ------------------------------------------------------------------------------------------------------------------------
-- ADMIN

 CREATE TABLE `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `admin_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

  -- ------------------------------------------------------------------------------------------------------------------------

-- ORGANIZATION
  CREATE TABLE `organizationaccount` (
  `org_id` int(11) UNSIGNED NOT NULL,
  `org_email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `org_status` varchar(50) NOT NULL,
  `isVerified` tinyint(1)NOT NULL DEFAULT 0,
  `isActivated` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  CREATE TABLE `organizationprofile` (
  `org_id` int(11) UNSIGNED NOT NULL,
  `org_name` varchar(100) NOT NULL,
  `acronym` varchar(30) NOT NULL,
  `org_category` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT 'N/A',
  `objectives` varchar(200) NOT NULL DEFAULT 'N/A',
  `org_website` varchar(50) NOT NULL DEFAULT 'N/A/',
  `mailing_address` varchar(100) NOT NULL DEFAULT 'N/A/',
  `date_established` varchar(50) NOT NULL,
  `org_logo` varchar(150) NOT NULL DEFAULT 'logo_default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `organizationaccount`
  ADD PRIMARY KEY (`org_id`),
  ADD UNIQUE KEY `org_email` (`org_email`);

ALTER TABLE `organizationaccount`
  MODIFY `org_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `organizationprofile`
  ADD KEY `org_id` (`org_id`);

ALTER TABLE `organizationprofile`
  ADD CONSTRAINT `organizationprofile_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
-- ACCREDITATION APPLICATION

CREATE TABLE `accreditationapplication` (
  `app_id` int(11) UNSIGNED NOT NULL,
  `org_id` int(11) UNSIGNED NOT NULL,
  `form_A` varchar(50) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `accreditationapplication`
  ADD PRIMARY KEY (`app_id`);

ALTER TABLE `accreditationapplication`
  ADD KEY `org_id` (`org_id`);

ALTER TABLE `accreditationapplication`
  ADD CONSTRAINT `accreditationapplication_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
-- ANNOUNCEMENTS
 CREATE TABLE `announcement` (
  `notice_ID` int(11) UNSIGNED NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL, 
  `recipient` int(11) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `announcement`
  ADD PRIMARY KEY (`notice_ID`);

ALTER TABLE `announcement`
  MODIFY `notice_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `announcement`
  ADD KEY `recipient` (`recipient`);

ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`recipient`) REFERENCES `organizationaccount` (`org_id`);

ALTER TABLE `announcement`
  ADD KEY `sender` (`sender`);

ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `admin` (`admin_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ORG MEMBERS
CREATE TABLE `orgmember` (
   `membership_id` int(11) UNSIGNED NOT NULL,
   `org_id` int(11) UNSIGNED NOT NULL,
   `student_id` int(11) UNSIGNED NOT NULL,
   `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orgmember`
  ADD PRIMARY KEY (`membership_id`);

ALTER TABLE `orgmember`
  MODIFY `membership_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `orgmember`
  ADD KEY `org_id` (`org_id`),
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `orgmember`
  ADD CONSTRAINT `orgmember_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`),
  ADD CONSTRAINT `orgmember_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studentaccount` (`student_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ORG POSTS
CREATE TABLE `orgpost` (
   `post_id` int(11) UNSIGNED NOT NULL,
   `org_id` int(11) UNSIGNED NOT NULL,
   `content` varchar(500) NOT NULL DEFAULT "No details",
   `date_posted` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orgpost`
  ADD PRIMARY KEY (`post_id`);

ALTER TABLE `orgpost`
  MODIFY `post_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

 ALTER TABLE `orgpost`
  ADD KEY `org_id` (`org_id`);

ALTER TABLE `orgpost`
  ADD CONSTRAINT `orgpost_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ORG APPLICATIONS
CREATE TABLE `orgapplication` (
   `orgapp_id` int(11) UNSIGNED NOT NULL,
   `org_id` int(11) UNSIGNED NOT NULL,
   `student_id` int(11) UNSIGNED NOT NULL,
   `status` varchar(50) NOT NULL DEFAULT 'Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orgapplication`
  ADD PRIMARY KEY (`orgapp_id`);

ALTER TABLE `orgapplication`
  MODIFY `orgapp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `orgapplication`
  ADD KEY `org_id` (`org_id`),
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `orgapplication`
  ADD CONSTRAINT `orgapplication_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`),
  ADD CONSTRAINT `orgapplication_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studentaccount` (`student_id`);

