-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 04:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vango`
--
CREATE DATABASE IF NOT EXISTS `vango` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vango`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_Booking_BookVan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_BookVan` (IN `pRoundID` VARCHAR(30), IN `pSeatID` VARCHAR(30), IN `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_booking:BEGIN

	IF (NOT EXISTS (SELECT 1 FROM tbl_t_round WHERE RoundID = pRoundID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถจองตั๋วได้ เนื่องจากไม่มีรอบการเดินรถที่คุณเลือก';
		LEAVE proc_booking;
	END IF;

	IF (EXISTS (SELECT 1 FROM tbl_t_BookVan WHERE RoundID = pRoundID AND SeatID = pSeatID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถจองตั๋วได้ เนื่องจากที่นั่งที่คุณเลือกมีการจองเรียบร้อยแล้ว';
		LEAVE proc_booking;
	END IF;

	SET @Price = (SELECT rt.Price FROM tbl_m_route rt 
								LEFT JOIN tbl_t_round rd ON rd.RouteID = rt.RouteID
								WHERE rd.RoundID = pRoundID);
	
	INSERT INTO tbl_t_bookvan (
		RoundID
		, SeatID
		, Price
		, BookingDate
		, BookingBy
	)
	VALUES (
		pRoundID
		, pSeatID
		, @Price
		, NOW()
		, pUserID
	);
	
END$$

DROP PROCEDURE IF EXISTS `sp_Booking_GetHeader`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_GetHeader` (IN `pRoundID` VARCHAR(30))  BEGIN
	
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

END$$

DROP PROCEDURE IF EXISTS `sp_Booking_GetSeatDetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_GetSeatDetail` (IN `pRoundID` VARCHAR(30))  BEGIN

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
	
END$$

DROP PROCEDURE IF EXISTS `sp_Booking_GetUserRound`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Booking_GetUserRound` ()  BEGIN

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
    FROM tbl_t_round rd
    LEFT JOIN tbl_m_route rt
        ON rd.RouteID = rt.RouteID
    LEFT JOIN tbl_m_van v
        ON rd.VanID = v.VanID
    LEFT JOIN tbl_m_employee dv
        ON rd.EmployeeID = dv.EmployeeID
    WHERE CONVERT(rd.RoundDate, DATE) = CONVERT(NOW(),DATE) 
    AND rd.RoundDate >= NOW()
    ORDER BY rd.RoundDate, rd.RouteID;

 

END$$

DROP PROCEDURE IF EXISTS `sp_Common_GetEmployeeCombo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_GetEmployeeCombo` ()  BEGIN
	
	SELECT EmployeeID
		, CONCAT(Name, ' ', Lastname) AS EmployeeName
	FROM tbl_m_employee
	WHERE FlagDelete = 0
	ORDER BY Name, Lastname
	;

END$$

DROP PROCEDURE IF EXISTS `sp_Common_GetRouteCombo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_GetRouteCombo` ()  BEGIN
	
	SELECT RouteID
		, CONCAT(Name, ' (', Begin, ' - ', Destination, ')')	AS RouteName
	FROM tbl_m_route
	ORDER BY Begin, Destination
	;

END$$

DROP PROCEDURE IF EXISTS `sp_Common_GetVanCombo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_GetVanCombo` ()  BEGIN
	
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

END$$

DROP PROCEDURE IF EXISTS `sp_Common_LoginUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_LoginUser` (IN `pUsername` VARCHAR(30), IN `pPassword` VARCHAR(30), IN `pRole` VARCHAR(1), OUT `ErrorMsg` VARCHAR(255))  BEGIN
	
	IF (pRole = 'A') THEN	
		SELECT EmployeeID	AS UserID
			, CONCAT(CONCAT(Name, ' '), Lastname)	AS UserInfo
			, 'A' AS Role
		FROM tbl_m_employee WHERE Telephone = pUsername AND `Password` = pPassword;
	ELSE
		SELECT UserID AS UserID
			, CONCAT(CONCAT(Name, ' '), Lastname) AS UserInfo
			, 'U' AS Role
		FROM tbl_m_user WHERE Telephone = pUsername AND `Password` = pPassword;
	END IF;
	

END$$

DROP PROCEDURE IF EXISTS `sp_Common_RegisterUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Common_RegisterUser` (IN `pName` VARCHAR(60), IN `pLastname` VARCHAR(60), IN `pEmail` VARCHAR(30), IN `pPassword` VARCHAR(30), IN `pPaymentNumber` VARCHAR(30), IN `pPaymentMethod` VARCHAR(30), IN `pSex` VARCHAR(10), IN `pTelephone` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_insert:BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_Employee_AddEmployee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Employee_AddEmployee` (IN `pName` VARCHAR(60), IN `pLastName` VARCHAR(60), IN `pEmail` VARCHAR(30), IN `pPassword` VARCHAR(30), IN `pSex` VARCHAR(10), IN `pTelephone` VARCHAR(30), IN `pBirthdate` DATE, OUT `ErrorMsg` VARCHAR(255))  proc_insert:BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_Employee_EditEmployee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Employee_EditEmployee` (IN `pEmployeeID` VARCHAR(30), IN `pName` VARCHAR(60), IN `pLastName` VARCHAR(60), IN `pEmail` VARCHAR(30), IN `pPassword` VARCHAR(30), IN `pTelephone` VARCHAR(30), IN `pFlagDelete` BIT, OUT `ErrorMsg` VARCHAR(255))  proc_update:BEGIN

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
	
END$$

DROP PROCEDURE IF EXISTS `sp_Employee_Getemployee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Employee_Getemployee` ()  BEGIN

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
		
END$$

DROP PROCEDURE IF EXISTS `sp_GenerateNewID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GenerateNewID` (IN `tableName` VARCHAR(100), IN `fieldName` VARCHAR(100), IN `prefix` VARCHAR(20), IN `unit` INT, OUT `runningNo` VARCHAR(30))  BEGIN
	SET @count = 1;
	SET @postfix = '';
	
	WHILE @count <= unit DO
		SET @postfix = CONCAT(@postfix, '0');
		SET @count = @count + 1;
	END WHILE;
	
	
	IF (tableName = 'tbl_t_round') THEN
		SET @sql_ =CONCAT('SELECT IFNULL ((SELECT CAST(RIGHT(',fieldName,', ',unit,') AS INT) + 1 
												FROM ',tableName,
												' WHERE LEFT(',fieldName,', 8) = LEFT(''',prefix,''', 8) 
												ORDER BY ',fieldName,' DESC LIMIT 1), 1)
												INTO @maxID');
		PREPARE statement_ FROM @sql_;
		EXECUTE statement_ ;
		DEALLOCATE PREPARE statement_;
		
	ELSE
		SET @sql_ =CONCAT('SELECT CAST(RIGHT(',fieldName,', ',unit,') AS INT) + 1 FROM ',tableName,' ORDER BY ',fieldName,' DESC LIMIT 1 INTO @maxID');
		PREPARE statement_ FROM @sql_;
		EXECUTE statement_ ;
		DEALLOCATE PREPARE statement_;
		
	END IF;
	
	SET @sql_Running = CONCAT('SELECT IF(EXISTS (SELECT 1 FROM ',tableName,') = 1
	, CONCAT(''',prefix,''', RIGHT(CONCAT(''',@postfix,''', @maxID), ',unit,'))
	, CONCAT(''',prefix,''', RIGHT(CONCAT(''',@postfix,''',''1''), ',unit,' )) ) 
	INTO @running');
	PREPARE statement1_ FROM @sql_Running;
	EXECUTE statement1_ ;
	DEALLOCATE PREPARE statement1_;
		
		
	SELECT @running	INTO runningNo;

END$$

DROP PROCEDURE IF EXISTS `sp_HistoryAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_HistoryAdmin` ()  BEGIN
	
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

END$$

DROP PROCEDURE IF EXISTS `sp_HistoryUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_HistoryUser` (IN `pUserID` VARCHAR(30))  BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_Round_AddRound`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_AddRound` (IN `pRoundDate` DATETIME, IN `pRouteID` VARCHAR(30), IN `pVanID` VARCHAR(30), IN `pEmployeeID` VARCHAR(30), IN `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  BEGIN
	
	SET @date = pRoundDate;
	CALL sp_GenerateNewID('tbl_t_Round', 'RoundID', CONCAT(DATE_FORMAT(@date, "%Y%m%d"), '-'), 3, @newID);
	
	INSERT INTO tbl_t_round (
		RoundID
		, RoundDate
		, RouteID
		, VanID
		, EmployeeID
		, CreateDate
		, CreateBy
		, UpdateDate
		, UpdateBy
	)
	VALUES (
		@newID
		, pRoundDate
		, pRouteID
		, pVanID
		, pEmployeeID
		, NOW()
		, pUserID
		, NOW()
		, pUserID
	);

END$$

DROP PROCEDURE IF EXISTS `sp_Round_DeleteRound`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_DeleteRound` (IN `pRoundID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_delete:BEGIN

	IF (EXISTS (SELECT 1 FROM tbl_t_BookVan WHERE RoundID = pRoundID) = 1) THEN
		SET ErrorMsg = 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีการจองตั๋วแล้ว';
		LEAVE proc_delete;
	END IF;

	DELETE FROM tbl_t_round
	WHERE RoundID = pRoundID;

END$$

DROP PROCEDURE IF EXISTS `sp_Round_EditRound`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_EditRound` (IN `pRoundID` VARCHAR(30), IN `pRouteID` VARCHAR(30), IN `pVanID` VARCHAR(30), IN `pEmployeeID` VARCHAR(30), IN `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_update:BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_Round_GetRound`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Round_GetRound` ()  BEGIN

	SELECT rd.RoundID
		, rd.RoundDate	AS RoundDateStart
		, DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE)	AS RoundDateEnd
		, DATE_FORMAT(rd.RoundDate, "%d-%b-%Y")	AS RoundDate
		, DATE_FORMAT(rd.RoundDate, "%H:%i")		AS DepartingTime
		, DATE_FORMAT(DATE_ADD(rd.RoundDate, INTERVAL rt.UsageTime MINUTE), "%H:%i")		AS ArrivingTime
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
	WHERE DATE_ADD(CONVERT(NOW(), DATE),INTERVAL 3 DAY) >= CONVERT(rd.RoundDate, DATE)
		AND DATE_ADD(CONVERT(NOW(), DATE),INTERVAL -3 DAY) <= CONVERT(rd.RoundDate, DATE)
	ORDER BY rd.RoundDate, rd.RouteID
	;

END$$

DROP PROCEDURE IF EXISTS `sp_Route_AddRoute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Route_AddRoute` (IN `pName` VARCHAR(30), IN `pBegin` VARCHAR(60), IN `pDestination` VARCHAR(60), IN `pUsageTime` INT, IN `pPrice` DECIMAL(9,2), IN `pDescription` TEXT, IN `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_insert:BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_Route_DeleteRoute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Route_DeleteRoute` (IN `pRouteID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_delete:BEGIN
	
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

END$$

DROP PROCEDURE IF EXISTS `sp_Route_EditRoute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Route_EditRoute` (IN `pRouteID` VARCHAR(30), IN `pName` VARCHAR(30), IN `pBegin` VARCHAR(60), IN `pDestination` VARCHAR(60), IN `pUsageTime` INT, IN `pPrice` DECIMAL(9,2), IN `pDescription` TEXT, IN `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_update:BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_route_getroute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_route_getroute` ()  BEGIN

    SELECT r.RouteID
			,r.Name
			,r.Begin
			,r.Destination
			,r.Usagetime
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
		
END$$

DROP PROCEDURE IF EXISTS `sp_Van_AddVanSeat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Van_AddVanSeat` (IN `pVanNumber` VARCHAR(30), IN `FuelType` VARCHAR(30), IN `UserID` VARCHAR(30), IN `SeatCount` INT, OUT `ErrorMsg` VARCHAR(255))  proc_insert:BEGIN
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
	
END$$

DROP PROCEDURE IF EXISTS `sp_Van_DeleteVanSeat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Van_DeleteVanSeat` (IN `pVanID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_delete:BEGIN
	
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

END$$

DROP PROCEDURE IF EXISTS `sp_Van_EditVanSeat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Van_EditVanSeat` (IN `pVanID` VARCHAR(30), IN `pVanNumber` VARCHAR(30), `pFuelType` VARCHAR(30), `pUserID` VARCHAR(30), OUT `ErrorMsg` VARCHAR(255))  proc_update:BEGIN

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

END$$

DROP PROCEDURE IF EXISTS `sp_van_getvan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_van_getvan` ()  BEGIN

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
		
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_m_employee`
--

DROP TABLE IF EXISTS `tbl_m_employee`;
CREATE TABLE `tbl_m_employee` (
  `EmployeeID` varchar(30) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Lastname` varchar(60) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Telephone` varchar(30) NOT NULL,
  `Birthdate` date NOT NULL,
  `FlagDelete` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_m_route`
--

DROP TABLE IF EXISTS `tbl_m_route`;
CREATE TABLE `tbl_m_route` (
  `RouteID` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Begin` varchar(60) NOT NULL,
  `Destination` varchar(60) NOT NULL,
  `UsageTime` int(11) NOT NULL COMMENT 'Minute',
  `Price` decimal(9,2) NOT NULL,
  `Description` text NOT NULL,
  `CreateDate` datetime NOT NULL,
  `CreateBy` varchar(30) NOT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_m_seat`
--

DROP TABLE IF EXISTS `tbl_m_seat`;
CREATE TABLE `tbl_m_seat` (
  `VanID` varchar(30) NOT NULL,
  `SeatID` varchar(30) NOT NULL,
  `SeatName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_m_user`
--

DROP TABLE IF EXISTS `tbl_m_user`;
CREATE TABLE `tbl_m_user` (
  `UserID` varchar(30) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Lastname` varchar(60) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `PaymentNumber` varchar(30) NOT NULL,
  `PaymentMethod` varchar(30) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Telephone` varchar(30) NOT NULL,
  `FlagDelete` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_m_van`
--

DROP TABLE IF EXISTS `tbl_m_van`;
CREATE TABLE `tbl_m_van` (
  `VanID` varchar(30) NOT NULL,
  `VanNumber` varchar(30) NOT NULL,
  `FuelType` varchar(30) DEFAULT NULL,
  `CreateDate` datetime NOT NULL,
  `CreateBy` varchar(30) NOT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_t_bookvan`
--

DROP TABLE IF EXISTS `tbl_t_bookvan`;
CREATE TABLE `tbl_t_bookvan` (
  `TransactionID` int(11) NOT NULL,
  `RoundID` varchar(30) NOT NULL,
  `SeatID` varchar(30) NOT NULL,
  `Price` decimal(9,2) NOT NULL,
  `BookingDate` datetime NOT NULL,
  `BookingBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_t_round`
--

DROP TABLE IF EXISTS `tbl_t_round`;
CREATE TABLE `tbl_t_round` (
  `RoundID` varchar(30) NOT NULL,
  `RoundDate` datetime NOT NULL,
  `RouteID` varchar(30) NOT NULL,
  `VanID` varchar(30) NOT NULL,
  `EmployeeID` varchar(30) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `CreateBy` varchar(30) NOT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_m_employee`
--
ALTER TABLE `tbl_m_employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `tbl_m_route`
--
ALTER TABLE `tbl_m_route`
  ADD PRIMARY KEY (`RouteID`);

--
-- Indexes for table `tbl_m_seat`
--
ALTER TABLE `tbl_m_seat`
  ADD PRIMARY KEY (`VanID`,`SeatID`);

--
-- Indexes for table `tbl_m_user`
--
ALTER TABLE `tbl_m_user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `tbl_m_van`
--
ALTER TABLE `tbl_m_van`
  ADD PRIMARY KEY (`VanID`);

--
-- Indexes for table `tbl_t_bookvan`
--
ALTER TABLE `tbl_t_bookvan`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `tbl_t_round`
--
ALTER TABLE `tbl_t_round`
  ADD PRIMARY KEY (`RoundID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_t_bookvan`
--
ALTER TABLE `tbl_t_bookvan`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
