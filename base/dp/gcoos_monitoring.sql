CREATE TABLE "Operator" ("ShortName" TEXT PRIMARY KEY  NOT NULL ,"LongName" TEXT,"OperatorURI" TEXT,"TechContactName" TEXT,"TechContactEmail" TEXT,"AdminContactName" TEXT,"AdminContactEmail" TEXT,"RegistryURL" TEXT,"AutoUpdate" INTEGER,"VocParameters" TEXT);
CREATE TABLE "Stations" ("ShortName" TEXT NOT NULL ,"PlatFormID" TEXT NOT NULL,"LastModified" TEXT,"Observation" TEXT NOT NULL ,"Status" TEXT NOT NULL  DEFAULT 'Operating' ,"HPos_Lat" FLOAT,"HPos_Lon" FLOAT,"VPos_Unit" TEXT,"VPos_Value" FLOAT,"Start_Date" TEXT,"End_Date" TEXT,"PlatFormURI" TEXT,"DataURI" TEXT,"Comments" TEXT, "Vertical_Datum" TEXT, "PlatFormName" TEXT, "R_Operator" TEXT, "LastRecord" TEXT, PRIMARY KEY ("ShortName","PlatFormID") );
