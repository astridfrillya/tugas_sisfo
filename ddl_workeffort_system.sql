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
id varchar2(10),
we_bd_id varchar2(10),
we_id varchar2(10),
constraint pk_we_bd PRIMARY KEY (id),
constraint fk_we_bd FOREIGN KEY (we_id) REFERENCES work_effort); 

create table we_party_assignment_data(
wepad_id varchar2(10),
we_id varchar2(10),
party_id varchar2(10),
we_role_type varchar2(50),
from_date varchar2(20),
thru_date varchar2(20),
com varchar2(50),
constraint pk_wepad PRIMARY KEY (wepad_id),
constraint fk_wepad FOREIGN KEY (we_id) REFERENCES work_effort,
constraint fk_wepad2 FOREIGN KEY (party_id) REFERENCES party);

create table party_skill_data(
party_id varchar2(10),
skill_type varchar2(50),
years_of_exp int,
rating int,
constraint fk_psd FOREIGN KEY (party_id) REFERENCES party);

create table we_status(
status_id varchar2(10),
id varchar2(10),
status varchar2(50),
constraint pk_we_status PRIMARY KEY (status_id),
constraint fk_we_status FOREIGN KEY (id) REFERENCES we_breakdown);

create table time_sheet_entry(
tse_id varchar2(10),
ts_from varchar2(20),
ts_thru varchar2(20),
party_id varchar(10),
we_id varchar2(10),
te_from varchar2(20),
te_thru varchar2(20),
hours int,
constraint pk_tse PRIMARY KEY (tse_id),
constraint fk_tse FOREIGN KEY (party_id) REFERENCES party);

create table rare_type(
raretype_id varchar2(10),
des varchar2(50),
constraint pk_rt PRIMARY KEY (raretype_id));

create table we_rate(
werate_id varchar2(10),
work_task varchar2(50),
party_id varchar2(10),
raretype_id varchar2(10),
from_date varchar2(10),
thru_date varchar2(10),
rate int,
constraint pk_werate PRIMARY KEY (werate_id),
constraint fk_werate FOREIGN KEY (party_id) REFERENCES party,
constraint fk_werate2 FOREIGN KEY (raretype_id) REFERENCES rare_type);

create table fixed_asset_type(
fat_id varchar2(10),
des varchar2(10),
parent_asset varchar2(30),
constraint pk_fat PRIMARY KEY (fat_id));

create table fixed_asset(
fasset_id varchar2(10),
fat_id varchar2(10),
name varchar2(50),
date_acquired varchar2(20),
last_service varchar2(20),
next_service varchar2(20),
prod_capacity int,
uom varchar2(20),
constraint pk_fasset PRIMARY KEY (fasset_id),
constraint fk_fasset FOREIGN KEY (fat_id) REFERENCES fixed_asset_type);

create table fixed_asset_assign(
faa_id varchar2(10),
we_id varchar2(10),
fat_id varchar2(10),
from_date varchar2(10),
thru_date varchar2(10),
comm varchar2(50),
constraint pk_faa PRIMARY KEY (faa_id),
constraint fk_faa FOREIGN KEY (we_id) REFERENCES work_effort,
constraint fk_faa2 FOREIGN KEY (fat_id) REFERENCES fixed_asset_type);

create table party_faa(
pfaa_id varchar2(10),
party_id varchar2(10),
fat_id varchar2(10),
start_date varchar2(10),
end_date varchar2(10),
status varchar2(20),
constraint pk_pfaa PRIMARY KEY (pfaa_id),
constraint fk_pfaa FOREIGN KEY (party_id) REFERENCES party,
constraint fk_pfaa2 FOREIGN KEY (fat_id) REFERENCES fixed_asset_type);

create table we_good_standard(
wegs_id varchar2(10),
wetype_id varchar2(10),
item varchar2(50),
est_quantity int,
est_cost int,
constraint pk_wegs PRIMARY KEY (wegs_id),
constraint fk_wegs FOREIGN KEY (wetype_id) REFERENCES we_type);

create table we_fa_req(
wefr_id varchar2(10),
wetype_id varchar2(10),
fat_id varchar2(10),
est_quantity int,
est_duration varchar2(20),
constraint pk_wefr PRIMARY KEY (wefr_id),
constraint fk_wefr FOREIGN KEY (wetype_id) REFERENCES we_type,
constraint fk_wefr2 FOREIGN KEY (fat_id) REFERENCES fixed_asset_type);


