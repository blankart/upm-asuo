-- STUDENT
CREATE TABLE `studentaccount` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `up_id` char(9) NOT NULL,
  `up_mail` varchar(50) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
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
  `year_level` varchar(12) NOT NULL,
  `contact_num` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL DEFAULT 'N/A',
  `profile_pic` varchar(40) NOT NULL DEFAULT 'default_male.jpg',
  `form5` varchar(40) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `studentaccount`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `up_mail` (`up_mail`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `studentaccount`
  MODIFY `student_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `studentprofile`
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `studentprofile`
  ADD CONSTRAINT `studentprofile_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `studentaccount` (`student_id`);

-- ------------------------------------------------------------------------------------------------------------------------
-- ADMIN

 CREATE TABLE `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
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
  `password` varchar(60) NOT NULL,
  `org_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `isVerified` tinyint(1)NOT NULL DEFAULT 0,
  `isActivated` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  CREATE TABLE `organizationprofile` (
  `org_id` int(11) UNSIGNED NOT NULL,
  `org_name` varchar(100) NOT NULL,
  `acronym` varchar(30) NOT NULL,
  `org_category` varchar(30) NOT NULL,
  `org_college` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL DEFAULT 'N/A',
  `objectives` varchar(300) NOT NULL DEFAULT 'N/A',
  `org_website` varchar(50) NOT NULL DEFAULT 'N/A/',
  `mailing_address` varchar(100) NOT NULL DEFAULT 'N/A',
  `date_established` varchar(20) NOT NULL DEFAULT 'N/A',
  `org_logo` varchar(40) NOT NULL DEFAULT 'logo_default.jpg',
  `constitution` varchar(40) NOT NULL DEFAULT 'No uploads yet',
  `incSEC` tinyint(1) NOT NULL DEFAULT 0,
  `sec_years` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `organizationaccount`
  ADD PRIMARY KEY (`org_id`),
  ADD UNIQUE KEY `org_email` (`org_email`);

ALTER TABLE `organizationaccount`
  MODIFY `org_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `organizationprofile`
  ADD KEY `org_id` (`org_id`);

ALTER TABLE `organizationprofile`
  ADD CONSTRAINT `organizationprofile_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);
-- ----------------------------------------------------------------------------------------------------------------------------
-- ACADEMIC YEAR

CREATE TABLE `academicyear` (
  `AY_id` int(11) UNSIGNED NOT NULL,
  `year_start` int(4) UNSIGNED NOT NULL,
  `year_end` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`AY_id`);

ALTER TABLE `academicyear`
  MODIFY `AY_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;



    -- ----------------------------------------------------------------------------------------------------------------------------
  -- ACCREDITATION PERIOD
  CREATE TABLE `accreditation_period` (
    `period_id` int(11) UNSIGNED NOT NULL,
    `AY_id` int(11) UNSIGNED NOT NULL,
    `admin_id` int(11) UNSIGNED NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `status` varchar(20) NOT NULL DEFAULT "Closed" 
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  ALTER TABLE `accreditation_period`
  ADD PRIMARY KEY (`period_id`);

  ALTER TABLE `accreditation_period`
  MODIFY `period_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  ALTER TABLE `accreditation_period`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `AY_id` (`AY_id`);

  ALTER TABLE `accreditation_period`
  ADD CONSTRAINT `accreditation_period_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `accreditation_period_ibfk_2` FOREIGN KEY (`AY_id`) REFERENCES `academicyear` (`AY_id`);

   -- ----------------------------------------------------------------------------------------------------------------------------
-- ACCREDITATION APPLICATION

CREATE TABLE `accreditationapplication` (
  `app_id` int(11) UNSIGNED NOT NULL,
  `AY_id` int(11) UNSIGNED NOT NULL,
  `org_id` int(11) UNSIGNED NOT NULL,
  `app_status` varchar (15) NOT NULL DEFAULT 'On Progress',
  `form_A` varchar(40) NOT NULL DEFAULT 'No Submission',
  `form_B` varchar(40) NOT NULL DEFAULT 'No Submission',
  `form_C` varchar(40) NOT NULL DEFAULT 'No Submission',
  `form_D` varchar(40) NOT NULL DEFAULT 'No Submission',
  `form_E` varchar(40) NOT NULL DEFAULT 'No Submission',
  `form_F` varchar(40) NOT NULL DEFAULT 'No Submission',
  `form_G` varchar(40) NOT NULL DEFAULT 'No Submission',
  `plans` varchar(40) NOT NULL DEFAULT 'No Submission'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `accreditationapplication`
  ADD PRIMARY KEY (`app_id`);

ALTER TABLE `accreditationapplication`
  MODIFY `app_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `accreditationapplication`
  ADD KEY `org_id` (`org_id`),
  ADD KEY `AY_id` (`AY_id`);

ALTER TABLE `accreditationapplication`
  ADD CONSTRAINT `accreditationapplication_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`),
  ADD CONSTRAINT `accreditationapplication_ibfk_2` FOREIGN KEY (`AY_id`) REFERENCES `academicyear` (`AY_id`);


  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ACCREDITATION 
  CREATE TABLE `accreditation` (
    `accreditation_id` int(11) UNSIGNED NOT NULL,
    `AY_id` int(11) UNSIGNED NOT NULL,
    `org_id` int(11) UNSIGNED NOT NULL,
    `archived` tinyint(1) NOT NULL DEFAULT 1
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  ALTER TABLE `accreditation`
  ADD PRIMARY KEY (`accreditation_id`);

  ALTER TABLE `accreditation`
  MODIFY `accreditation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  ALTER TABLE `accreditation`
  ADD KEY `AY_id` (`AY_id`),
  ADD KEY `org_id` (`org_id`);

  ALTER TABLE `accreditation`
  ADD CONSTRAINT `accreditation_ibfk_1` FOREIGN KEY (`AY_id`) REFERENCES `academicyear` (`AY_id`),
  ADD CONSTRAINT `accreditation_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);

  -- -----------------------------------------------------------------------------------------------------------------------------
 -- FORM A DETAILS
CREATE TABLE `form_a_details` (
  `app_id` int(11) UNSIGNED NOT NULL,
  `stay` varchar (3) NOT NULL,
  `experience` int(11) UNSIGNED NOT NULL,
  `adviser` varchar (50) NOT NULL,
  `adviser_position` varchar (50) NOT NULL,
  `adviser_college` varchar (30) NOT NULL,
  `contact_person` varchar (100) NOT NULL,
  `contact_position` varchar (50) NOT NULL,
  `contact_email` varchar (50) NOT NULL,
  `contact_address` varchar(100) NOT NULL,
  `contact_tel` varchar(11) NOT NULL,
  `contact_mobile` varchar(11) NOT NULL,
  `contact_other_details` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `form_a_details`
  ADD PRIMARY KEY (`app_id`);

ALTER TABLE `form_a_details`
  ADD CONSTRAINT `form_a_details_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `accreditationapplication` (`app_id`);


  -- ----------------------------------------------------------------------------------------------------------------------------
-- ANNOUNCEMENTS
 CREATE TABLE `announcement` (
  `notice_ID` int(11) UNSIGNED NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL, 
  `title` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `announcement`
  ADD PRIMARY KEY (`notice_ID`);

ALTER TABLE `announcement`
  MODIFY `notice_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `announcement`
  ADD KEY `sender` (`sender`);

ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `admin` (`admin_id`);


-- ----------------------------------------------------------------------------------------------------------------------------
-- RECIPIENTS
CREATE TABLE `recipient` (
  `recipient_id` int(11) UNSIGNED NOT NULL,
  `notice_ID` int(11) UNSIGNED NOT NULL,
  `org_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `recipient`
  ADD PRIMARY KEY (`recipient_id`);

ALTER TABLE `recipient`
  MODIFY `recipient_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `recipient`
  ADD KEY `notice_ID` (`notice_ID`),
  ADD KEY `org_id` (`org_id`);

ALTER TABLE `recipient`
  ADD CONSTRAINT `recipient_ibfk_1` FOREIGN KEY (`notice_ID`) REFERENCES `announcement` (`notice_ID`),
  ADD CONSTRAINT `recipient_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ORG MEMBERS
CREATE TABLE `orgmember` (
   `membership_id` int(11) UNSIGNED NOT NULL,
   `org_id` int(11) UNSIGNED NOT NULL,
   `student_id` int(11) UNSIGNED NOT NULL,
   `position` varchar(20) NOT NULL,
   `isRemoved` tinyint(1) NOT NULL DEFAULT 1,
   `removal_reason` varchar(100) NOT NULL DEFAULT 'Not removed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orgmember`
  ADD PRIMARY KEY (`membership_id`);

ALTER TABLE `orgmember`
  MODIFY `membership_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

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
   `title` varchar(50) NOT NULL DEFAULT "Untitled",
   `content` varchar(500) NOT NULL DEFAULT "No details",
   `privacy` varchar(20) NOT NULL DEFAULT "Public",
   `date_posted` DATETIME NOT NULL,
   `archived` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orgpost`
  ADD PRIMARY KEY (`post_id`);

ALTER TABLE `orgpost`
  MODIFY `post_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

 ALTER TABLE `orgpost`
  ADD KEY `org_id` (`org_id`);

ALTER TABLE `orgpost`
  ADD CONSTRAINT `orgpost_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ORG APPLICATIONS (status: Pending, Approved, Rejected)
CREATE TABLE `orgapplication` (
   `orgapp_id` int(11) UNSIGNED NOT NULL,
   `org_id` int(11) UNSIGNED NOT NULL,
   `student_id` int(11) UNSIGNED NOT NULL,
   `status` varchar(50) NOT NULL DEFAULT 'Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orgapplication`
  ADD PRIMARY KEY (`orgapp_id`);

ALTER TABLE `orgapplication`
  MODIFY `orgapp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `orgapplication`
  ADD KEY `org_id` (`org_id`),
  ADD KEY `student_id` (`student_id`);

ALTER TABLE `orgapplication`
  ADD CONSTRAINT `orgapplication_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizationaccount` (`org_id`),
  ADD CONSTRAINT `orgapplication_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studentaccount` (`student_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- ORG APPLICATIONS (Pending, Verified, Removed), type 1 = student, 2 = org
CREATE TABLE `verificationcode` (
   `code_id` int(11) UNSIGNED NOT NULL,
   `type` varchar(7) NOT NULL DEFAULT 'None',
   `user_id` int(11) UNSIGNED NOT NULL,
   `code` varchar(32) NOT NULL DEFAULT 'None',
   `status` varchar(10) NOT NULL DEFAULT 'Removed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `verificationcode`
  ADD PRIMARY KEY (`code_id`);

ALTER TABLE `verificationcode`
  MODIFY `code_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- LOGIN NOTICE
  CREATE TABLE `login_notice` (
    `announcement_id` int(11) UNSIGNED NOT NULL,
    `admin_id` int(11) UNSIGNED NOT NULL,
    `title` varchar(50) NOT NULL DEFAULT "Untitled",
    `content` varchar(500) NOT NULL DEFAULT "No details",
    `date_posted` DATETIME NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  ALTER TABLE `login_notice`
  ADD PRIMARY KEY (`announcement_id`);

  ALTER TABLE `login_notice`
  MODIFY `announcement_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  ALTER TABLE `login_notice`
  ADD KEY `admin_id` (`admin_id`);

  ALTER TABLE `login_notice`
  ADD CONSTRAINT `login_notice_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

  -- ----------------------------------------------------------------------------------------------------------------------------
  -- LOGIN NOTICE
  CREATE TABLE `student_notice` (
    `announcement_id` int(11) UNSIGNED NOT NULL,
    `admin_id` int(11) UNSIGNED NOT NULL,
    `student_id` int(11) UNSIGNED NOT NULL,
    `content` varchar(200) NOT NULL DEFAULT "No details",
    `date_posted` DATETIME NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  ALTER TABLE `student_notice`
  ADD PRIMARY KEY (`announcement_id`);

  ALTER TABLE `student_notice`
  MODIFY `announcement_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  ALTER TABLE `student_notice`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `student_id` (`student_id`);

  ALTER TABLE `student_notice`
  ADD CONSTRAINT `student_notice_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `student_notice_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studentaccount` (`student_id`);

 -- ----------------------------------------------------------------------------------------------------------------------------
  -- RESTRICTED ACRONYMS

  CREATE TABLE `restrictedacronym` (
   `res_id` int(11) UNSIGNED NOT NULL,
   `acronym` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
