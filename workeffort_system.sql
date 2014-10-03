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
 
 create table party(
 party_id varchar2(10),
 name varchar2(30),
 constraint pk_party PRIMARY KEY (party_id));
 
create table party_work_req_role(
pwrr_id varchar2(10),
work_req_id varchar2(10),
rrt_id varchar2(10),
party_id varchar2(10),
from_date varchar2(20),
thru_date varchar2(20),
constraint pk_pwrr PRIMARY KEY (pwrr_id),
constraint fk_pwrr FOREIGN KEY (work_req_id) REFERENCES work_req,
constraint fk_pwrr2 FOREIGN KEY (rrt_id) REFERENCES req_role_type,
constraint fk_pwrr3 FOREIGN KEY (party_id) REFERENCES party);

create table order_item(
oi_seq_id varchar2(10),
est_deliv_date varchar2(20),
quantity int,
unit_price int,
constraint pk_oi PRIMARY KEY (oi_seq_id));

 create table we_type(
 wetype_id varchar2(10),
 des varchar2(50),
 standard_work_hours int,
 constraint pk_we_type PRIMARY KEY (wetype_id));
 
 create table work_effort(
we_id varchar2(10),
wetype_id varchar2(10),
name varchar2(30),
des varchar2(50),
start_date varchar2(20),
completion_date varchar2(20),
estimated_hours int,
constraint pk_we PRIMARY KEY (we_id),
constraint fk_we FOREIGN KEY (wetype_id) REFERENCES we_type);

create table we_from_order_item(
wfoi_id varchar2(10),
we_id varchar2(10),
oi_seq_id varchar2(10),
req_item varchar2(10),
constraint pk_wfoi PRIMARY KEY (wfoi_id),
constraint fk_wfoi FOREIGN KEY (oi_seq_id) REFERENCES order_item,
constraint fk_wfoi2 FOREIGN KEY (we_id) REFERENCES work_effort);

create table we_from_work_req(
wfwr_id varchar2(10),
we_id varchar2(10),
work_req_id varchar2(10),
constraint pk_wfwr PRIMARY KEY (wfwr_id),
constraint fk_wfwr FOREIGN KEY (we_id) REFERENCES work_effort,
constraint fk_wfwr2 FOREIGN KEY (work_req_id) REFERENCES work_req);

create table we_breakdown(
we_bd_id varchar2(10),
we_id varchar2(10),
wetype_id varchar2(10),
wfwr_id varchar2(10),
wfoi_id varchar2(10),
constraint pk_we_bd PRIMARY KEY (we_bd_id),
constraint fk_we_bd FOREIGN KEY (we_id) REFERENCES work_effort,
constraint fk_we_bd2 FOREIGN KEY (wetype_id) REFERENCES we_type,
constraint fk_we_bd3 FOREIGN KEY (wfwr_id) REFERENCES we_from_work_req,
constraint fk_we_bd4 FOREIGN KEY (wfoi_id) REFERENCES we_from_order_item); 

