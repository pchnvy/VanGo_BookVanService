/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : vango

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 13/06/2020 23:42:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_m_employee
-- ----------------------------
DROP TABLE IF EXISTS `tbl_m_employee`;
CREATE TABLE `tbl_m_employee`  (
  `EmployeeID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Lastname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telephone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Birthdate` date NOT NULL,
  `FlagDelete` bit(1) NOT NULL,
  PRIMARY KEY (`EmployeeID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_m_route
-- ----------------------------
DROP TABLE IF EXISTS `tbl_m_route`;
CREATE TABLE `tbl_m_route`  (
  `RouteID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Begin` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Destination` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UsageTime` int(11) NOT NULL COMMENT 'Minute',
  `Price` decimal(9, 2) NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CreateDate` datetime(0) NOT NULL,
  `CreateBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UpdateDate` datetime(0) DEFAULT NULL,
  `UpdateBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`RouteID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_m_seat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_m_seat`;
CREATE TABLE `tbl_m_seat`  (
  `VanID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SeatID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SeatName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`VanID`, `SeatID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_m_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_m_user`;
CREATE TABLE `tbl_m_user`  (
  `UserID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Lastname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PaymentNumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PaymentMethod` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telephone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FlagDelete` bit(1) NOT NULL,
  PRIMARY KEY (`UserID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_m_van
-- ----------------------------
DROP TABLE IF EXISTS `tbl_m_van`;
CREATE TABLE `tbl_m_van`  (
  `VanID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `VanNumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FuelType` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreateDate` datetime(0) NOT NULL,
  `CreateBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UpdateDate` datetime(0) DEFAULT NULL,
  `UpdateBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`VanID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_t_bookvan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_t_bookvan`;
CREATE TABLE `tbl_t_bookvan`  (
  `TransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `RoundDate` date DEFAULT NULL,
  `RoundID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SeatID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` decimal(9, 2) NOT NULL,
  `BookingDate` datetime(0) NOT NULL,
  `BookingBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FlagUpload` bit(1) DEFAULT NULL,
  `UploadDate` datetime(0) DEFAULT NULL,
  `FlagConfirm` bit(1) DEFAULT NULL,
  `ConfirmDate` datetime(0) DEFAULT NULL,
  `ConfirmBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `FilePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`TransactionID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_t_round
-- ----------------------------
DROP TABLE IF EXISTS `tbl_t_round`;
CREATE TABLE `tbl_t_round`  (
  `RoundID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `RoundTime` time(0) NOT NULL,
  `RouteID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `VanID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EmployeeID` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FlagDelete` bit(1) DEFAULT NULL,
  `CreateDate` datetime(0) NOT NULL,
  `CreateBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UpdateDate` datetime(0) DEFAULT NULL,
  `UpdateBy` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`RoundID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Procedure structure for sp_Booking_BookVan
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Booking_BookVan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_BookVan`(IN `pRoundDate` int,IN `pRoundID` varchar(30),IN `pSeatID` varchar(30),IN `pUserID` varchar(30),OUT `ErrorMsg` varchar(255))
proc_booking:BEGIN

-- 	IF (NOT EXISTS (SELECT 1 FROM tbl_t_round WHERE RoundID = pRoundID) = 1) THEN
-- 		SET ErrorMsg = 'ไม่สามารถจองตั๋วได้ เนื่องจากไม่มีรอบการเดินรถที่คุณเลือก';
-- 		LEAVE proc_booking;
-- 	END IF;
-- 
-- 	IF (EXISTS (SELECT 1 FROM tbl_t_BookVan WHERE RoundDate = pRoundDate AND RoundID = pRoundID AND SeatID = pSeatID) = 1) THEN
-- 		SET ErrorMsg = 'ไม่สามารถจองตั๋วได้ เนื่องจากที่นั่งที่คุณเลือกมีการจองเรียบร้อยแล้ว';
-- 		LEAVE proc_booking;
-- 	END IF;
	
	SET @dateString = pRoundDate;
	SET @dateObject = FROM_UNIXTIME(@dateString, '%Y-%m-%d');

	SET @Price = (SELECT rt.Price FROM tbl_m_route rt 
								LEFT JOIN tbl_t_round rd ON rd.RouteID = rt.RouteID
								WHERE rd.RoundID = pRoundID);
	
	INSERT INTO tbl_t_bookvan (
		RoundDate
		, RoundID
		, SeatID
		, Price
		, BookingDate
		, BookingBy
		, FlagUpload
	)
	VALUES (
		CAST(@dateObject AS DATE)
		, pRoundID
		, pSeatID
		, @Price
		, NOW()
		, pUserID
		, 0
	);
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Booking_GetHeader
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Booking_GetHeader`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_GetHeader`(IN `pRoundID` varchar(30), IN `pRoundDate` int)
BEGIN

	SET @dateString = pRoundDate;
	SET @dateObject = FROM_UNIXTIME(@dateString, '%Y-%m-%d');
	
	SELECT rd.RoundID
        , DATE_FORMAT(rd.RoundTime, "%H:%i")        AS DepartingTime
        , DATE_FORMAT(DATE_ADD(rd.RoundTime, INTERVAL rt.UsageTime MINUTE), "%H:%i")        AS ArrivingTime
        , rt.Price AS Price
        , rd.RouteID
        , CONCAT(rt.Begin, ' - ', rt.Destination)    AS RouteName
        , rd.VanID
        , v.VanNumber
        , rd.EmployeeID
        , CONCAT(dv.Name, ' ', dv.Lastname)    AS EmployeeName
				, dv.Telephone
				, s.SeatCount
				, IFNULL(book.SoldCount, 0)	AS SoldCount
				, s.SeatCount - IFNULL(book.SoldCount, 0)	AS RemainSeatCount
    FROM tbl_t_round rd
    LEFT JOIN tbl_m_route rt
        ON rd.RouteID = rt.RouteID
    LEFT JOIN tbl_m_van v
        ON rd.VanID = v.VanID
    LEFT JOIN tbl_m_employee dv
        ON rd.EmployeeID = dv.EmployeeID
		LEFT JOIN (
			SELECT VanID
				, COUNT(SeatID) AS SeatCount
			FROM tbl_m_seat
			GROUP BY VanID
		) s ON rd.VanID = s.VanID
		LEFT JOIN (
			SELECT RoundDate
				, RoundID
				, Price
				, COUNT(RoundID)	AS SoldCount
			FROM tbl_t_bookvan
			GROUP BY RoundDate
				, RoundID
		) book ON rd.RoundID = book.RoundID
			AND DATE_FORMAT(book.RoundDate, '%Y-%m-%d') = @dateObject
    WHERE rd.RoundID = pRoundID
    ;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Booking_GetSeatDetail
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Booking_GetSeatDetail`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_GetSeatDetail`(IN `pRoundID` varchar(30), IN `pRoundDate` int)
BEGIN

	SET @dateString = pRoundDate;
	SET @dateObject = FROM_UNIXTIME(@dateString, '%Y-%m-%d');

	
	SELECT IFNULL(book.RoundDate, CAST(@dateObject AS DATE)) AS RoundDate
		, rd.RoundID
		, rd.VanID
		, s.SeatID
		, s.SeatName
		, CASE WHEN book.SeatID IS NOT NULL THEN 0 
			ELSE 1 END    AS Available
	FROM tbl_t_round rd
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_seat s
		ON s.VanID = v.VanID
	LEFT JOIN tbl_t_bookvan book
    ON book.RoundID = rd.RoundID
    AND book.SeatID = s.SeatID
		AND IFNULL(DATE_FORMAT(book.RoundDate, '%Y-%m-%d'), @dateObject) = @dateObject
	WHERE rd.RoundID = pRoundID
	ORDER BY s.SeatID
	;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Booking_GetUserRound
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Booking_GetUserRound`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_GetUserRound`(IN `pRouteID` varchar(30))
BEGIN

    SELECT rd.RoundID
        , DATE_FORMAT(rd.RoundTime, "%H:%i")        AS DepartingTime
        , DATE_FORMAT(DATE_ADD(rd.RoundTime, INTERVAL rt.UsageTime MINUTE), "%H:%i")        AS ArrivingTime
        , rt.Price AS Price
        , rd.RouteID
        , CONCAT(rt.Begin, ' - ', rt.Destination)    AS RouteName
        , rd.VanID
        , v.VanNumber
        , rd.EmployeeID
        , CONCAT(dv.Name, ' ', dv.Lastname)    AS EmployeeName
    FROM tbl_t_round rd
    LEFT JOIN tbl_m_route rt
        ON rd.RouteID = rt.RouteID
    LEFT JOIN tbl_m_van v
        ON rd.VanID = v.VanID
    LEFT JOIN tbl_m_employee dv
        ON rd.EmployeeID = dv.EmployeeID
		WHERE (pRouteID IS NULL OR pRouteID = '' OR pRouteID = rt.RouteID)
		AND rd.FlagDelete = 0
    ORDER BY rt.Begin, rt.Destination, rd.RoundTime;
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Booking_UploadFile
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Booking_UploadFile`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_UploadFile`(IN `pRoundDate` int,IN `pRoundID` varchar(30),IN `pUserID` varchar(30),IN `pFileUpload` varchar(255),OUT `ErrorMsg` varchar(255))
BEGIN

	SET @dateString = pRoundDate;
	SET @dateObject = FROM_UNIXTIME(@dateString, '%Y-%m-%d');
	
	UPDATE tbl_t_bookvan
	SET FlagUpload = 1
		, UploadDate = NOW()
		, FilePath = pFileUpload
	WHERE DATE_FORMAT(RoundDate, '%Y-%m-%d') = @dateObject
		AND RoundID = pRoundID
		AND BookingBy = pUserID
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Common_GetEmployeeCombo
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Common_GetEmployeeCombo`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_GetEmployeeCombo`()
BEGIN
	
	SELECT EmployeeID
		, CONCAT(Name, ' ', Lastname) AS EmployeeName
	FROM tbl_m_employee
	WHERE FlagDelete = 0
	ORDER BY Name, Lastname
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Common_GetRouteCombo
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Common_GetRouteCombo`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_GetRouteCombo`()
BEGIN
	
	SELECT RouteID
		, CONCAT(Name, ' (', Begin, ' - ', Destination, ')')	AS RouteName
		, CONCAT(Begin, ' - ', Destination)	AS RouteFromTo
	FROM tbl_m_route
	ORDER BY Begin, Destination
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Common_GetVanCombo
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Common_GetVanCombo`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_GetVanCombo`()
BEGIN
	
	SELECT v.VanID
		, CONCAT(v.VanNumber, ' (', s.SeatCount,' ที่นั่ง)') AS VanNumber
	FROM tbl_m_van v
	LEFT JOIN (
		SELECT VanID
			, COUNT(SeatID) AS SeatCount
		FROM tbl_m_seat
		GROUP BY VanID
	) s ON v.VanID = s.VanID
	ORDER BY v.VanNumber
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Common_LoginUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Common_LoginUser`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_LoginUser`(IN `pUsername` varchar(30),IN `pPassword` varchar(30),IN `pRole` varchar(1),OUT `ErrorMsg` varchar(255))
BEGIN
	
	IF (pRole = 'A') THEN	
		SELECT EmployeeID	AS UserID
			, CONCAT(CONCAT(Name, ' '), Lastname)	AS UserInfo
			, 'A' AS Role
		FROM tbl_m_employee WHERE Email = pUsername AND `Password` = pPassword;
	ELSE
		SELECT UserID AS UserID
			, CONCAT(CONCAT(Name, ' '), Lastname) AS UserInfo
			, 'U' AS Role
		FROM tbl_m_user WHERE Email = pUsername AND `Password` = pPassword;
	END IF;
	

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Common_RegisterUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Common_RegisterUser`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_RegisterUser`(IN `pName` varchar(60),IN `pLastname` varchar(60),IN `pEmail` varchar(30),IN `pPassword` varchar(30),IN `pPaymentNumber` varchar(30),IN `pPaymentMethod` varchar(30),IN `pSex` varchar(10),IN `pTelephone` varchar(30),OUT `ErrorMsg` varchar(255))
proc_insert:BEGIN

	IF (EXISTS (SELECT 1 FROM tbl_m_user WHERE Name = pName AND Lastname = pLastName) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถสมัครสมาชิกได้ เนื่องจากข้อมูลผู้ใช้นี้มีในฐานข้อมูลแล้ว';
		LEAVE proc_insert;
	END IF;
	
	IF (EXISTS (SELECT 1 FROM tbl_m_user WHERE Email = pEmail) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถสมัครสมาชิกได้ เนื่องจากอีเมลล์ซ้ำกับผู้อื่น';
		LEAVE proc_insert;
	END IF;

	IF (EXISTS (SELECT 1 FROM tbl_m_user WHERE Telephone = pTelephone) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถสมัครสมาชิกได้ เนื่องจากเบอร์โทรศัพท์ซ้ำกับผู้อื่น';
		LEAVE proc_insert;
	END IF;
	
	CALL sp_GenerateNewID('tbl_m_user', 'UserID', 'USER', 6, @newID);
	
	INSERT INTO tbl_m_user (
		UserID
		, Name
		, Lastname
		, Email
		, Password
		, PaymentNumber
		, PaymentMethod
		, Sex
		, Telephone
		, FlagDelete
	)
	VALUES (
		@newID
		, pName
		, pLastname
		, pEmail
		, pPassword
		, pPaymentNumber
		, pPaymentMethod
		, pSex
		, pTelephone
		, 0
	);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Confirm_ConfirmBill
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Confirm_ConfirmBill`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Confirm_ConfirmBill`(IN `pRoundDate` int,IN `pRoundID` varchar(30),IN `pBookingBy` varchar(30),IN `pUserID` varchar(30),IN `pIsConfirm` int,OUT `ErrorMsg` varchar(255))
BEGIN

	SET @dateString = pRoundDate;
	SET @dateObject = FROM_UNIXTIME(@dateString, '%Y-%m-%d');
	
	IF (pIsConfirm = 1) THEN
		UPDATE tbl_t_bookvan
		SET FlagConfirm = 1
			, ConfirmDate = NOW()
			, ConfirmBy = pUserID
		WHERE DATE_FORMAT(RoundDate, '%Y-%m-%d') = @dateObject
			AND RoundID = pRoundID
			AND BookingBy = pBookingBy
		;
	ELSE
		UPDATE tbl_t_bookvan
		SET FlagUpload = 0
			, UploadDate = null
			, FlagConfirm = 0
			, ConfirmDate = NOW()
			, ConfirmBy = pUserID
		WHERE DATE_FORMAT(RoundDate, '%Y-%m-%d') = @dateObject
			AND RoundID = pRoundID
			AND BookingBy = pBookingBy
		;
	END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Confirm_GetBill
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Confirm_GetBill`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Confirm_GetBill`()
BEGIN
	
	SELECT DATE_FORMAT(bv.RoundDate, "%d-%b-%Y") AS RoundDate
		, bv.RoundID
		, CONCAT(rt.Begin, ' - ', rt.Destination) AS RouteName
		, DATE_FORMAT(rd.RoundTime, "%H:%i")        AS DepartingTime
    , DATE_FORMAT(DATE_ADD(rd.RoundTime, INTERVAL rt.UsageTime MINUTE), "%H:%i")        AS ArrivingTime
		, GROUP_CONCAT(s.SeatName)	AS SeatNameList
		, COUNT(bv.Price)	AS TotalSeat
		, CONCAT(COUNT(bv.Price), ' ที่นั่ง x ', bv.Price, ' = ', SUM(bv.Price), ' บาท')	AS TotalPrice
		, bv.BookingDate
		, bv.BookingBy
		, CONCAT(bk.Name, ' ', bk.Lastname) AS BookingByName
		, bk.Telephone	AS BookingPhone
		, CASE WHEN bv.FlagUpload = 0 AND (bv.FlagConfirm !=1 OR bv.FlagConfirm IS NULL) THEN 'รอการอัพโหลด'
				WHEN bv.FlagUpload = 1 AND (bv.FlagConfirm !=1 OR bv.FlagConfirm IS NULL) THEN 'รอการยืนยัน'
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1 THEN 'ยืนยันแล้ว'
				END AS StatusName
		, bv.FlagUpload
		, bv.UploadDate
		, bv.FilePath
		, bv.FlagConfirm
		, bv.ConfirmBy
		, bv.ConfirmDate
	FROM tbl_t_bookvan bv
	LEFT JOIN tbl_t_round rd
		ON bv.RoundID = rd.RoundID
	LEFT JOIN tbl_m_route rt
		ON rd.RouteID = rt.RouteID
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_seat s
		ON s.VanID = v.VanID
		AND bv.SeatID = s.SeatID
	LEFT JOIN tbl_m_user bk
		ON bk.UserID = bv.BookingBy
	GROUP BY bv.RoundDate
		, bv.RoundID
		, bv.BookingBy
		, bv.FilePath
	ORDER BY bv.FlagUpload DESC, bv.UploadDate DESC, bv.RoundDate DESC, rt.Begin, rt.Destination
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Employee_AddEmployee
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Employee_AddEmployee`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Employee_AddEmployee`(IN `pName` varchar(60),IN `pLastName` varchar(60),IN `pEmail` varchar(30),IN `pPassword` varchar(30),IN `pSex` varchar(10),IN `pTelephone` varchar(30),IN `pBirthdate` date,OUT `ErrorMsg` varchar(255))
proc_insert:BEGIN

	IF (EXISTS (SELECT 1 FROM tbl_m_Employee WHERE Name = pName AND Lastname = pLastName) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากข้อมูลพนักงานนี้มีในฐานข้อมูลแล้ว';
		LEAVE proc_insert;
	END IF;
	
	IF (EXISTS (SELECT 1 FROM tbl_m_Employee WHERE Email = pEmail) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากอีเมลล์ซ้ำกับผู้อื่น';
		LEAVE proc_insert;
	END IF;

	IF (EXISTS (SELECT 1 FROM tbl_m_Employee WHERE Telephone = pTelephone) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากเบอร์โทรศัพท์ซ้ำกับผู้อื่น';
		LEAVE proc_insert;
	END IF;
	
	CALL sp_GenerateNewID('tbl_m_Employee', 'EmployeeID', 'EMP', 4, @newID);
	
	INSERT INTO tbl_m_Employee (
		EmployeeID
		, Name
		, Lastname
		, Email
		, Password
		, Sex
		, Telephone
		, Birthdate
		, FlagDelete
	)
	VALUES (
		@newID
		, pName
		, pLastname
		, pEmail
		, pPassword
		, pSex
		, pTelephone
		, pBirthdate
		, 0
	);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Employee_EditEmployee
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Employee_EditEmployee`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Employee_EditEmployee`(IN `pEmployeeID` varchar(30),IN `pName` varchar(60),IN `pLastName` varchar(60),IN `pEmail` varchar(30),IN `pPassword` varchar(30),IN `pTelephone` varchar(30), IN `pFlagDelete` bit,OUT `ErrorMsg` varchar(255))
proc_update:BEGIN

	IF (EXISTS (SELECT 1 FROM tbl_m_Employee WHERE (Name = pName AND Lastname = pLastName) AND EmployeeID <> pEmployeeID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากข้อมูลพนักงานนี้มีในฐานข้อมูลแล้ว';
		LEAVE proc_update;
	END IF;
	
	IF (EXISTS (SELECT 1 FROM tbl_m_Employee WHERE Email = pEmail AND EmployeeID <> pEmployeeID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากอีเมลล์ซ้ำกับผู้อื่น';
		LEAVE proc_update;
	END IF;

	IF (EXISTS (SELECT 1 FROM tbl_m_Employee WHERE Telephone = pTelephone AND EmployeeID <> pEmployeeID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากเบอร์โทรศัพท์ซ้ำกับผู้อื่น';
		LEAVE proc_update;
	END IF;
	
	UPDATE tbl_m_Employee
	SET Name = pName
			, Lastname = pLastname
			, Email = pEmail
			, Password = pPassword
			, Telephone = pTelephone
			, FlagDelete = pFlagDelete
	WHERE EmployeeID = pEmployeeID;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Employee_Getemployee
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Employee_Getemployee`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Employee_Getemployee`()
BEGIN

    SELECT EmployeeID
			,Name
			,LastName
			,Email
			,Sex
			,Telephone
			,DATE_FORMAT(Birthdate, "%d-%b-%Y") AS Birthdate
			,FlagDelete
		FROM tbl_m_employee
		;
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_GenerateNewID
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_GenerateNewID`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GenerateNewID`(IN `tableName` varchar(100),IN `fieldName` varchar(100),IN `prefix` varchar(20),IN `unit` int,OUT `runningNo` varchar(30))
BEGIN
	SET @count = 1;
	SET @postfix = '';
	
	WHILE @count <= unit DO
		SET @postfix = CONCAT(@postfix, '0');
		SET @count = @count + 1;
	END WHILE;
	
	
-- 	IF (tableName = 'tbl_t_round') THEN
-- 		SET @sql_ =CONCAT('SELECT IFNULL ((SELECT CAST(RIGHT(',fieldName,', ',unit,') AS INT) + 1 
-- 												FROM ',tableName,
-- 												' WHERE LEFT(',fieldName,', 8) = LEFT(''',prefix,''', 8) 
-- 												ORDER BY ',fieldName,' DESC LIMIT 1), 1)
-- 												INTO @maxID');
-- 		PREPARE statement_ FROM @sql_;
-- 		EXECUTE statement_ ;
-- 		DEALLOCATE PREPARE statement_;
-- 		
-- 	ELSE
		SET @sql_ =CONCAT('SELECT CAST(RIGHT(',fieldName,', ',unit,') AS INT) + 1 FROM ',tableName,' ORDER BY ',fieldName,' DESC LIMIT 1 INTO @maxID');
		PREPARE statement_ FROM @sql_;
		EXECUTE statement_ ;
		DEALLOCATE PREPARE statement_;
		
-- 	END IF;
	
	SET @sql_Running = CONCAT('SELECT IF(EXISTS (SELECT 1 FROM ',tableName,') = 1
	, CONCAT(''',prefix,''', RIGHT(CONCAT(''',@postfix,''', @maxID), ',unit,'))
	, CONCAT(''',prefix,''', RIGHT(CONCAT(''',@postfix,''',''1''), ',unit,' )) ) 
	INTO @running');
	PREPARE statement1_ FROM @sql_Running;
	EXECUTE statement1_ ;
	DEALLOCATE PREPARE statement1_;
		
		
	SELECT @running	INTO runningNo;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_HistoryAdmin
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_HistoryAdmin`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_HistoryAdmin`(IN `pRoundDate` int)
BEGIN

	SET @dateString = pRoundDate;
	SET @dateObject = FROM_UNIXTIME(@dateString, '%Y-%m-%d');
	
	SELECT DATE_FORMAT(bv.RoundDate, "%d %b %Y")	AS RoundDate
		, rd.RoundID
		, DATE_FORMAT(rd.RoundTime, "%H:%i")		AS DepartingTime
		, DATE_FORMAT(DATE_ADD(rd.RoundTime, INTERVAL rt.UsageTime MINUTE), "%H:%i")		AS ArrivingTime
		, CONCAT(rt.Begin, ' - ', rt.Destination)	AS RouteName
		, v.VanID
		, v.VanNumber
		, CONCAT(dv.Name, ' ', dv.Lastname)	AS EmployeeName
		, dv.Telephone	AS EmployeePhone
		, IFNULL(bv.Price, rt.Price)	AS PricePerSeat
		, IFNULL(bv.Price, rt.Price) * IFNULL(book.SoldCount, 0)	AS TotalSales
		, CONCAT(IFNULL(book.SoldCount, 0), '/', s.SeatCount)	AS SoldSeat
		, CASE WHEN DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) <= NOW() 
					THEN 2
				WHEN DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) > NOW() AND ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime) <= NOW() 
					THEN 1
				ELSE 0 END	AS RoundStatus
		, CASE WHEN DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) <= NOW() 
					THEN 'ได้ถึงจุดหมายเรียบร้อยแล้ว'
				WHEN DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) > NOW() AND ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime) <= NOW() 
					THEN 'กำลังอยู่ระหว่างการเดินทาง'
				ELSE 'รอออกตามตารางเวลา' END	AS RoundStatusName
	FROM tbl_t_bookvan bv
	LEFT JOIN tbl_t_round rd
		ON bv.RoundID = rd.RoundID
	LEFT JOIN tbl_m_route rt
		ON rd.RouteID = rt.RouteID
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_employee dv
		ON rd.EmployeeID = dv.EmployeeID
	LEFT JOIN (
		SELECT VanID
			, COUNT(SeatID) AS SeatCount
		FROM tbl_m_seat
		GROUP BY VanID
	) s ON rd.VanID = s.VanID
	LEFT JOIN (
		SELECT RoundDate
			, RoundID
			, Price
			, COUNT(RoundID)	AS SoldCount
		FROM tbl_t_bookvan
		GROUP BY RoundDate
			,RoundID
	) book ON bv.RoundDate = book.RoundDate
		AND bv.RoundID = book.RoundID
	WHERE CONVERT(bv.RoundDate, DATE) <= CONVERT(NOW(), DATE)
		AND DATE_ADD(NOW(),INTERVAL -1 MONTH) <= CONVERT(bv.RoundDate, DATE)
		AND (pRoundDate IS NULL OR pRoundDate = '' OR DATE_FORMAT(bv.RoundDate, '%Y-%m-%d') = @dateObject)
	GROUP BY bv.RoundDate
		, bv.RoundID
	ORDER BY bv.RoundDate DESC, rd.RoundTime DESC, rt.UsageTime DESC, rd.RouteID
	;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_HistoryUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_HistoryUser`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_HistoryUser`(IN `pUserID` varchar(30))
BEGIN
	
	SELECT bv.RoundID
		, IFNULL(DATE_FORMAT(bv.RoundDate, "%d %b %Y"), NULL)	AS RoundDate
		, DATE_FORMAT(rd.RoundTime, "%H:%i")		AS DepartingTime
		, DATE_FORMAT(DATE_ADD(rd.RoundTime, INTERVAL rt.UsageTime MINUTE), "%H:%i")		AS ArrivingTime
		, CONCAT(rt.Begin, ' - ', rt.Destination)	AS RouteName
		, v.VanID
		, v.VanNumber
		, CONCAT(dv.Name, ' ', dv.Lastname)	AS EmployeeName
		, dv.Telephone	AS EmployeePhone
		, GROUP_CONCAT(s.SeatName)	AS SeatName
		, COUNT(bv.SeatID)	AS TotalSeat
		, SUM(bv.Price)	AS TotalPrice
		, CASE 
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1
				AND DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) <= NOW() 
					THEN 4
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1
				AND DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) > NOW() 
				AND ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime) <= NOW() 
					THEN 3
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1
					THEN 2
				WHEN bv.FlagUpload = 0
					THEN 1
				WHEN bv.FlagUpload = 1 AND (bv.FlagConfirm IS NULL OR bv.FlagConfirm = 0)
					THEN 0
				ELSE 0 END	AS RoundStatus
		, CASE 
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1
				AND DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) <= NOW() 
					THEN 'ได้ถึงจุดหมายเรียบร้อยแล้ว'
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1
				AND DATE_ADD(ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime), INTERVAL rt.UsageTime MINUTE) > NOW() 
				AND ADDTIME(CONVERT(bv.RoundDate, DATETIME), rd.RoundTime) <= NOW() 
					THEN 'กำลังอยู่ระหว่างการเดินทาง'
				WHEN bv.FlagUpload = 1 AND bv.FlagConfirm = 1
					THEN 'ได้รับชำระเงินของคุณเรียบร้อยแล้ว<br/><style='"color: red;"'>* โปรดแสดงหลักฐานการชำระเงินก่อนขึ้นรถโดยสาร *</style>'
				WHEN bv.FlagUpload = 0 
					THEN 'ต้องการให้คุณแนบหลักฐานการชำระเงิน'
				WHEN bv.FlagUpload = 1 AND (bv.FlagConfirm IS NULL OR bv.FlagConfirm = 0)
					THEN 'อยู่ระหว่างการตรวจสอบหลักฐานการชำระเงิน'
				ELSE 'อยู่ระหว่างการตรวจสอบ' END	AS RoundStatusName
	FROM tbl_t_bookvan bv
	LEFT JOIN tbl_t_round rd
		ON bv.RoundID = rd.RoundID
	LEFT JOIN tbl_m_route rt
		ON rd.RouteID = rt.RouteID
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_employee dv
		ON rd.EmployeeID = dv.EmployeeID
	LEFT JOIN tbl_m_seat s
		ON bv.SeatID = s.SeatID
		AND v.VanID = s.VanID

	WHERE bv.BookingBy = pUserID
	GROUP BY bv.RoundDate, RoundID
	ORDER BY bv.RoundDate DESC, rd.RouteID
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Round_AddRound
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Round_AddRound`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_AddRound`(IN `pRoundTime` TIME, IN `pRouteID` VARCHAR(30), IN `pVanID` VARCHAR(30), IN `pEmployeeID` VARCHAR(30), IN `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))
proc_insert:BEGIN
	
	CALL sp_GenerateNewID('tbl_t_Round', 'RoundID', 'RD', 3, @newID);
	
	IF (EXISTS (SELECT 1 FROM tbl_t_Round WHERE RouteID = pRouteID AND RoundTime = pRoundTime AND FlagDelete = 0) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากมีรอบเวลาการเดินรถนี้แล้ว';
		LEAVE proc_insert;
	END IF;
	
	IF (EXISTS (SELECT 1 FROM tbl_t_Round WHERE RouteID = pRouteID AND RoundTime = pRoundTime AND (VanID = pVanID OR EmployeeID = pEmployeeID) AND FlagDelete = 0) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากรอบเวลาการเดินรถนี้ รถหรือพนักงานขับรถที่เลือกไม่ว่าง';
		LEAVE proc_insert;
	END IF;
	
	INSERT INTO tbl_t_round (
		RoundID
		, RoundTime
		, RouteID
		, VanID
		, EmployeeID
		, FlagDelete
		, CreateDate
		, CreateBy
		, UpdateDate
		, UpdateBy
	)
	VALUES (
		@newID
		, pRoundTime
		, pRouteID
		, pVanID
		, pEmployeeID
		, 0
		, NOW()
		, pUserID
		, NOW()
		, pUserID
	);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Round_DeleteRound
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Round_DeleteRound`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_DeleteRound`(IN `pRoundID` varchar(30),OUT `ErrorMsg` varchar(255))
proc_delete:BEGIN

-- 	IF (EXISTS (SELECT 1 FROM tbl_t_BookVan WHERE RoundID = pRoundID) = 1) THEN
-- 		SET ErrorMsg = 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีการจองตั๋วแล้ว';
-- 		LEAVE proc_delete;
-- 	END IF;
-- 
-- 	DELETE FROM tbl_t_round
-- 	WHERE RoundID = pRoundID;

	UPDATE tbl_t_round
	SET FlagDelete = 1
	WHERE RoundID = pRoundID;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Round_EditRound
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Round_EditRound`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_EditRound`(IN `pRoundID` varchar(30),IN `pRouteID` varchar(30),IN `pVanID` varchar(30),IN `pEmployeeID` varchar(30),IN `pUserID` varchar(30),OUT `ErrorMsg` varchar(255))
proc_update:BEGIN

	IF (EXISTS (SELECT 1 FROM tbl_t_BookVan WHERE RoundID = pRoundID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากมีการจองตั๋วแล้ว';
		LEAVE proc_update;
	END IF;
	
	UPDATE tbl_t_round
	SET RouteID = pRouteID
		, VanID = pVanID
		, EmployeeID = pEmployeeID
		, UpdateDate = NOW()
		, UpdateBy = pUserID
	WHERE RoundID = pRoundID;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Round_GetRound
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Round_GetRound`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_GetRound`()
BEGIN
	
	SELECT rd.RoundID
		, DATE_FORMAT(rd.RoundTime, "%H:%i")		AS DepartingTime
		, DATE_FORMAT(DATE_ADD(rd.RoundTime, INTERVAL rt.UsageTime MINUTE), "%H:%i")		AS ArrivingTime
		, rd.RouteID
		, CONCAT(rt.Begin, ' - ', rt.Destination)	AS RouteName
		, rd.VanID
		, v.VanNumber
		, rd.EmployeeID
		, CONCAT(dv.Name, ' ', dv.Lastname)	AS EmployeeName
		, DATE_FORMAT(rd.CreateDate, "%d-%b-%Y %H:%i") AS CreateDate
		, CONCAT(ec.Name, ' ', ec.Lastname)	AS CreateBy
		, DATE_FORMAT(rd.UpdateDate, "%d-%b-%Y %H:%i") AS UpdateDate
		, CONCAT(eu.Name, ' ', eu.Lastname)	AS UpdateBy
	FROM tbl_t_round rd
	LEFT JOIN tbl_m_route rt
		ON rd.RouteID = rt.RouteID
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_employee dv
		ON rd.EmployeeID = dv.EmployeeID
	LEFT JOIN tbl_m_employee ec
		ON ec.EmployeeID = rd.CreateBy
	LEFT JOIN tbl_m_employee eu
		ON eu.EmployeeID = rd.UpdateBy
	WHERE rd.FlagDelete = 0
	ORDER BY rt.Begin, rt.Destination, rd.RoundTime
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Route_AddRoute
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Route_AddRoute`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Route_AddRoute`(IN `pName` varchar(30),IN `pBegin` varchar(60),IN `pDestination` varchar(60),IN `pUsageTime` int,IN `pPrice` decimal(9,2),IN `pDescription` text,IN `pUserID` varchar(30),OUT `ErrorMsg` varchar(255))
proc_insert:BEGIN

	IF (pBegin = pDestination) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากข้อมูลจุดเริ่มต้น หรือจุดปลายทางไม่ถูกต้อง';
		LEAVE proc_insert;
	END IF;

	IF (EXISTS (SELECT 1 FROM tbl_m_route WHERE `Begin` = pBegin AND Destination = pDestination) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากข้อมูลเส้นทางการเดินรถนี้มีในฐานข้อมูลแล้ว';
		LEAVE proc_insert;
	END IF;

	CALL sp_GenerateNewID('tbl_m_route', 'RouteID', 'R', 2, @newID);
	
	INSERT INTO tbl_m_route (
		RouteID
		, Name
		, Begin
		, Destination
		, UsageTime
		, Price
		, Description
		, CreateDate
		, CreateBy
		, UpdateDate
		, UpdateBy
	)
	VALUES (
		@newID
		, pName
		, PBegin
		, pDestination
		, pUsageTime
		, pPrice
		, pDescription
		, NOW()
		, pUserID
		, NOW()
		, pUserID
	);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Route_DeleteRoute
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Route_DeleteRoute`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Route_DeleteRoute`(IN `pRouteID` varchar(30),OUT `ErrorMsg` varchar(255))
proc_delete:BEGIN
	
	IF (EXISTS (SELECT 1 FROM tbl_t_Round r INNER JOIN tbl_t_BookVan bv ON bv.RoundID = r.RoundID WHERE RouteID = pRouteID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีการจองตั๋วแล้ว';
		LEAVE proc_delete;
	END IF;
	
	IF (EXISTS (SELECT 1 FROM tbl_t_Round WHERE RouteID = pRouteID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้ข้อมูลเส้นทางการเดินรถแล้ว';
		LEAVE proc_delete;
	END IF;

	DELETE FROM tbl_m_Route
	WHERE RouteID = pRouteID;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Route_EditRoute
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Route_EditRoute`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Route_EditRoute`(IN `pRouteID` varchar(30),IN `pName` varchar(30),IN `pBegin` varchar(60),IN `pDestination` varchar(60),IN `pUsageTime` int,IN `pPrice` decimal(9,2),IN `pDescription` text,IN `pUserID` varchar(30),OUT `ErrorMsg` varchar(255))
proc_update:BEGIN

	IF (pBegin = pDestination) THEN
		SET ErrorMsg = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากข้อมูลจุดเริ่มต้น หรือจุดปลายทางไม่ถูกต้อง';
		LEAVE proc_update;
	END IF;

	IF (EXISTS (SELECT 1 FROM tbl_m_route WHERE (`Begin` = pBegin AND Destination = pDestination) AND RouteID <> pRouteID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากข้อมูลเส้นทางการเดินรถนี้มีในฐานข้อมูลแล้ว';
		LEAVE proc_update;
	END IF;
	
	UPDATE tbl_m_Route
	SET Name = pName
		, Begin = pBegin
		, Destination = pDestination
		, UsageTime = pUsageTime
		, Price = pPrice
		, Description = pDescription
		, UpdateDate = NOW()
		, UpdateBy = pUserID
	WHERE RouteID = pRouteID;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_route_getroute
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_route_getroute`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_route_getroute`()
BEGIN

    SELECT r.RouteID
			,r.Name
			,r.Begin
			,r.Destination
			,TRUNCATE(r.Usagetime / 60, 2) AS Usagetime
			,r.Price
			,r.Description
			,DATE_FORMAT(r.CreateDate, "%d-%b-%Y %H:%i") AS CreateDate
			,CONCAT(ec.Name, ' ', ec.Lastname)	AS CreateBy
			,DATE_FORMAT(r.UpdateDate, "%d-%b-%Y %H:%i") AS UpdateDate
			,CONCAT(eu.Name, ' ', eu.Lastname)	AS UpdateBy
		FROM tbl_m_route r
		LEFT JOIN tbl_m_employee ec
			ON ec.EmployeeID = r.CreateBy
		LEFT JOIN tbl_m_employee eu
			ON eu.EmployeeID = r.UpdateBy;
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Van_AddVanSeat
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Van_AddVanSeat`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Van_AddVanSeat`(IN `pVanNumber` varchar(30),IN `FuelType` varchar(30),IN `UserID` varchar(30), IN `SeatCount` int, OUT `ErrorMsg` varchar(255))
proc_insert:BEGIN
	DECLARE seatNo INT DEFAULT 1;
	
	SET @dupVanID = (SELECT VanID FROM tbl_m_van WHERE VanNumber = pVanNumber);
	
	IF (EXISTS (SELECT 1 FROM tbl_m_van WHERE VanNumber = pVanNumber) = 1) THEN
		SET ErrorMsg = CONCAT('ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากมีทะเบียนรถนี้แล้ว (',@dupVanID,')');
		LEAVE proc_insert;
	END IF;
	
	CALL sp_GenerateNewID('tbl_m_van', 'VanID', 'VAN', 3, @newID);
	
	INSERT INTO `tbl_m_van` (`VanID`, `VanNumber`, `FuelType`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`)
	VALUES (@newID, pVanNumber, FuelType, NOW(), UserID, NOW(), UserID);
	
	DELETE FROM `tbl_m_seat` WHERE `VanID` = @newID;
	WHILE seatNo <= SeatCount DO		
		INSERT INTO `tbl_m_seat` (`VanID`, `SeatID`, `SeatName`)
		VALUES(
			@newID
			, CONCAT('S', RIGHT(CONCAT('00', seatNo), 2))
			, CONCAT('Seat ', RIGHT(CONCAT('00', seatNo), 2))
		);
		
		SET seatNo = seatNo + 1;
	END WHILE;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Van_DeleteVanSeat
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Van_DeleteVanSeat`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Van_DeleteVanSeat`(IN `pVanID` varchar(30), OUT `ErrorMsg` varchar(255))
proc_delete:BEGIN
	
	IF (EXISTS (SELECT 1 FROM tbl_t_Round r INNER JOIN tbl_t_BookVan bv ON bv.RoundID = r.RoundID WHERE  VanID = pVanID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีการจองตั๋วแล้ว';
		LEAVE proc_delete;
	END IF;
	
	IF (EXISTS (SELECT 1 FROM tbl_t_Round WHERE VanID = pVanID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้ข้อมูลรถตู้/ที่นั่งแล้ว';
		LEAVE proc_delete;
	END IF;

	DELETE FROM tbl_m_seat
	WHERE VanID = pVanID;
	
	DELETE FROM tbl_m_van
	WHERE VanID = pVanID;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_Van_EditVanSeat
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Van_EditVanSeat`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Van_EditVanSeat`(IN `pVanID` varchar(30),IN `pVanNumber` varchar(30),`pFuelType` varchar(30),`pUserID` varchar(30), OUT `ErrorMsg` varchar(255))
proc_update:BEGIN

	SET @dupVanID = (SELECT VanID FROM tbl_m_van WHERE VanNumber = pVanNumber AND VanID <> pVanID);
	
	IF (EXISTS (SELECT 1 FROM tbl_m_van WHERE VanNumber = pVanNumber AND VanID <> pVanID) = 1) THEN
		SET ErrorMsg = CONCAT('ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากมีทะเบียนรถนี้แล้ว (',@dupVanID,')');
		LEAVE proc_update;
	END IF;
	
	UPDATE `tbl_m_van`
	SET `VanNumber` = pVanNumber
		, `FuelType` = pFuelType
		, `UpdateDate` = NOW()
		, `UpdateBy` = pUserID
	WHERE `VanID` = pVanID;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_van_getvan
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_van_getvan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_van_getvan`()
BEGIN

    SELECT v.VanID
			,v.VanNumber
			,COUNT(s.SeatID) AS SeatCount
			,v.Fueltype
			,DATE_FORMAT(v.CreateDate, "%d-%b-%Y %H:%i") AS CreateDate
			,CONCAT(ec.Name, ' ', ec.Lastname)	AS CreateBy
			,DATE_FORMAT(v.UpdateDate, "%d-%b-%Y %H:%i") AS UpdateDate
			,CONCAT(eu.Name, ' ', eu.Lastname)	AS UpdateBy
		FROM tbl_m_van v
		JOIN tbl_m_seat s
			ON v.VanID = s.VanID
		LEFT JOIN tbl_m_employee ec
			ON ec.EmployeeID = v.CreateBy
		LEFT JOIN tbl_m_employee eu
			ON eu.EmployeeID = v.UpdateBy
		GROUP BY v.vanID;
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for tmp_sp_Booking_GetHeader
-- ----------------------------
DROP PROCEDURE IF EXISTS `tmp_sp_Booking_GetHeader`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `tmp_sp_Booking_GetHeader`(IN `pRoundID` VARCHAR(30))
BEGIN
	
	SELECT rd.RoundID
        , rd.RoundDate    AS RoundDateStart
        , DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE)    AS RoundDateEnd
        , DATE_FORMAT(rd.RoundDate, "%d-%b-%Y")    AS RoundDate
        , DATE_FORMAT(rd.RoundDate, "%H:%i")        AS DepartingTime
        , DATE_FORMAT(DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE), "%H:%i")        AS ArrivingTime
        , rt.Price AS Price
        , rd.RouteID
        , CONCAT(rt.Begin, ' - ', rt.Destination)    AS RouteName
        , rd.VanID
        , v.VanNumber
        , rd.EmployeeID
        , CONCAT(dv.Name, ' ', dv.Lastname)    AS EmployeeName
				, dv.Telephone
				, s.SeatCount
				, IFNULL(book.SoldCount, 0)	AS SoldCount
				, s.SeatCount - IFNULL(book.SoldCount, 0)	AS RemainSeatCount
    FROM tbl_t_round rd
    LEFT JOIN tbl_m_route rt
        ON rd.RouteID = rt.RouteID
    LEFT JOIN tbl_m_van v
        ON rd.VanID = v.VanID
    LEFT JOIN tbl_m_employee dv
        ON rd.EmployeeID = dv.EmployeeID
		LEFT JOIN (
			SELECT VanID
				, COUNT(SeatID) AS SeatCount
			FROM tbl_m_seat
			GROUP BY VanID
		) s ON rd.VanID = s.VanID
		LEFT JOIN (
			SELECT RoundID
				, Price
				, COUNT(RoundID)	AS SoldCount
			FROM tbl_t_bookvan
			GROUP BY RoundID
		) book ON rd.RoundID = book.RoundID
    WHERE rd.RoundID = pRoundID
    ;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for tmp_sp_Booking_GetSeatDetail
-- ----------------------------
DROP PROCEDURE IF EXISTS `tmp_sp_Booking_GetSeatDetail`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `tmp_sp_Booking_GetSeatDetail`(IN `pRoundID` VARCHAR(30))
BEGIN
	
	SELECT rd.RoundID
		, rd.VanID
		, s.SeatID
		, s.SeatName
		, CASE WHEN book.SeatID IS NOT NULL THEN 0 
			ELSE 1 END    AS Available
	FROM tbl_t_round rd
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_seat s
		ON s.VanID = v.VanID
	LEFT JOIN tbl_t_bookvan book
    ON book.RoundID = rd.RoundID
    AND book.SeatID = s.SeatID
	WHERE rd.RoundID = pRoundID
	ORDER BY s.SeatID
	;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for tmp_sp_HistoryAdmin
-- ----------------------------
DROP PROCEDURE IF EXISTS `tmp_sp_HistoryAdmin`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `tmp_sp_HistoryAdmin`()
BEGIN
	
	SELECT DATE_FORMAT(rd.RoundDate, "%d %b %Y")	AS RoundDate
		, rd.RoundID
		, DATE_FORMAT(rd.RoundDate, "%H:%i")		AS DepartingTime
		, DATE_FORMAT(DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE), "%H:%i")		AS ArrivingTime
		, CONCAT(rt.Begin, ' - ', rt.Destination)	AS RouteName
		, v.VanID
		, v.VanNumber
		, CONCAT(dv.Name, ' ', dv.Lastname)	AS EmployeeName
		, IFNULL(book.Price, rt.Price)	AS PricePerSeat
		, IFNULL(book.Price, rt.Price) * IFNULL(book.SoldCount, 0)	AS TotalSales
		, CONCAT(IFNULL(book.SoldCount, 0), '/', s.SeatCount)	AS SoldSeat
		, CASE WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) <= NOW() THEN 2
				WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) > NOW() AND rd.RoundDate <= NOW() THEN 1
				ELSE 0 END	AS RoundStatus
		, CASE WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) <= NOW() THEN 'ได้ถึงจุดหมายเรียบร้อยแล้ว'
				WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) > NOW() AND rd.RoundDate <= NOW() THEN 'กำลังอยู่ระหว่างการเดินทาง'
				ELSE 'รอออกตามตารางเวลา' END	AS RoundStatusName
	FROM tbl_t_round rd
	LEFT JOIN tbl_m_route rt
		ON rd.RouteID = rt.RouteID
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_employee dv
		ON rd.EmployeeID = dv.EmployeeID
	LEFT JOIN (
		SELECT VanID
			, COUNT(SeatID) AS SeatCount
		FROM tbl_m_seat
		GROUP BY VanID
	) s ON rd.VanID = s.VanID
	LEFT JOIN (
		SELECT RoundID
			, Price
			, COUNT(RoundID)	AS SoldCount
		FROM tbl_t_bookvan
		GROUP BY RoundID
	) book ON rd.RoundID = book.RoundID
	WHERE CONVERT(rd.RoundDate, DATE) <= CONVERT(NOW(), DATE)
		AND DATE_ADD(NOW(),INTERVAL -1 MONTH) <= CONVERT(rd.RoundDate, DATE)
	GROUP BY rd.RoundDate
		, rd.RouteID
		, rt.UsageTime
		, rt.Begin
		, rt.Destination
		, v.VanID
		, v.VanNumber
		, dv.Name
		, dv.Lastname

	ORDER BY rd.RoundDate DESC, rd.RouteID
	;	

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for tmp_sp_HistoryUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `tmp_sp_HistoryUser`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `tmp_sp_HistoryUser`(IN `pUserID` varchar(30))
BEGIN

	SELECT bv.RoundID
		, DATE_FORMAT(rd.RoundDate, "%d %b %Y")	AS RoundDate
		, DATE_FORMAT(rd.RoundDate, "%H:%i")		AS DepartingTime
		, DATE_FORMAT(DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE), "%H:%i")		AS ArrivingTime
		, CONCAT(rt.Begin, ' - ', rt.Destination)	AS RouteName
		, v.VanID
		, v.VanNumber
		, CONCAT(dv.Name, ' ', dv.Lastname)	AS EmployeeName
		, dv.Telephone	AS EmployeePhone
		, GROUP_CONCAT(s.SeatName)	AS SeatName
		, COUNT(bv.SeatID)	AS TotalSeat
		, SUM(bv.Price)	AS TotalPrice
		, CASE WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) <= NOW() THEN 2
				WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) > NOW() AND rd.RoundDate <= NOW() THEN 1
				ELSE 0 END	AS RoundStatus
		, CASE WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) <= NOW() THEN 'ได้ถึงจุดหมายเรียบร้อยแล้ว'
				WHEN DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE) > NOW() AND rd.RoundDate <= NOW() THEN 'กำลังอยู่ระหว่างการเดินทาง'
				ELSE 'ได้รับชำระเงินของคุณเรียบร้อยแล้ว<br/><style='"color: red;"'>* โปรดแสดงหลักฐานการชำระเงินก่อนขึ้นรถโดยสาร *</style>' END	AS RoundStatusName
	FROM tbl_t_bookvan bv
	LEFT JOIN tbl_t_round rd
		ON bv.RoundID = rd.RoundID
	LEFT JOIN tbl_m_route rt
		ON rd.RouteID = rt.RouteID
	LEFT JOIN tbl_m_van v
		ON rd.VanID = v.VanID
	LEFT JOIN tbl_m_employee dv
		ON rd.EmployeeID = dv.EmployeeID
	LEFT JOIN tbl_m_seat s
		ON bv.SeatID = s.SeatID
		AND v.VanID = s.VanID

	WHERE bv.BookingBy = pUserID
	GROUP BY bv.RoundID
	ORDER BY rd.RoundDate DESC, rd.RouteID
	;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
