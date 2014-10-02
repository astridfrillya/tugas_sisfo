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
 
 create table req_role_type(
 rrt_id varchar2(10),
 des varchar2(30),
 constraint pk_rrt PRIMARY KEY (rrt_id));
 
create table party_work_req_role(
pwrr_id varchar2(10),
work_req_id varchar2(10),
rrt_id varchar2(10),
from_date varchar2(20),
thru_date varchar2(20),
constraint pk_pwrr PRIMARY KEY (pwrr_id),
constraint fk_pwrr FOREIGN KEY (work_req_id) REFERENCES work_req,
constraint fk_pwrr2 FOREIGN KEY (rrt_id) REFERENCES req_role_type);

create table we_from_work_req(
we_id varchar2(10),
name varchar2(20),
des varchar2(50),
start_date varchar2(20),
work_req_id varchar2(10),
constraint pk_wfwr PRIMARY KEY (we_id),
constraint fk_wfwr FOREIGN KEY (work_req_id) REFERENCES work_req);

