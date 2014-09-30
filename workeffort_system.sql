======================================DDL=================================================

create table req_type(
req_type_id varchar2(10),
description varchar2(50),
constraint pk_req_type PRIMARY KEY (req_type_id));

create table work_req(
work_req_id varchar2(10),
req_type_id varchar2(10),
req_creation_date varchar2(20),
req_by_date varchar2(20),
description varchar2(50),
constraint pk_work_req PRIMARY KEY (work_req_id),
constraint fk_work_req FOREIGN KEY (req_type_id) REFERENCES req_type);

 create table work_req_type(
 wrt_id varchar2(10),
 work_req_id varchar2(10),
 description varchar2(50),
 product varchar2(50),
 quantity int,
 deliverable varchar2(50),
 constraint pk_work_req_type PRIMARY KEY (wrt_id),
 constraint fk_work_req_type FOREIGN KEY (work_req_id) REFERENCES work_req);