I have created 2 web services. One is for Fetch the Event List and another is for Create Event. No front end validation. All the required validation is written in server side. No pagination is given.

API to List the events
URL: moud.in/beta/missioncoordination/events/getAllevents
Req type: GET

Api is written in framework of php(Codeigniter)
Code of this API is
/***********************/
    public function getAllevents($page=0){
        
        ##data is coming from model
        $events = $this->Common_model->getAllEventdata(EVENTS);
        $response_array = array();
        
        if($events){
           $data_array = array();
            foreach($events as $data){
                $temp_array = array(
                    'event_name' => $data->event_name,
                    'org_name' => $data->org_name,
                    'evnt_date' => $data->evnt_date,
                    'evnt_time' => $data->evnt_time,
                    'location' => $data->location,
                );
                array_push($data_array, $temp_array);
            }
            $response_array = array(
                'status' => '1',
                'data' => $data_array,
                'total'=> count($data_array)
            );
            echo json_encode($response_array);
        }else{
            
             $response_array = array(
                'status' => '0',
                'data' => 'No record found',
            );
            echo json_encode($response_array);
            exit;
        }
        
    }
 /********************************/

API to Create the events
URL: moud.in/beta/missioncoordination/events/index
Req type: POST
No of Parameters = 5(event_name,org_name,evnt_date,evnt_time)


Api is written in framework of php(Codeigniter)
Code of this API is
/********************************/
    public function index(){
        
        $event = $this->input->post('event_name');
        $org_name = $this->input->post('org_name');
        $evnt_date = $this->input->post('evnt_date');
        $evnt_time = $this->input->post('evnt_time');
        $location = $this->input->post('location');
        
        $response_arr = array();
        
        if($event == ''){
            
            $response_array = array(
                'status' => '0',
                'response' => 'Event name is required',
            );
            echo json_encode($response_array);
            exit;
        }
        
        if($org_name == ''){
            
            $response_array = array(
                'status' => '0',
                'response' => 'Organiser name is required',
            );
            echo json_encode($response_array);
            exit;
        }
        
        if($evnt_date == ''){
            
            $response_array = array(
                'status' => '0',
                'response' => 'Event date is required',
            );
            echo json_encode($response_array);
            exit;
        }
        
        if($evnt_time == ''){
            
            $response_array = array(
                'status' => '0',
                'response' => 'Event time is required',
            );
            echo json_encode($response_array);
            exit;
        }
        
        if($location == ''){
            
            $response_array = array(
                'status' => '0',
                'response' => 'Event loction is required',
            );
            echo json_encode($response_array);
            exit;
        }
        
        $ins_array = array(
            'event_name' => $event,
            'org_name' => $org_name,
            'evnt_date' => $evnt_date,
            'evnt_time' => $evnt_time,
            'location'  => $location
        );
        
        $insRes = $this->Common_model->insertRecord(EVENTS,$ins_array);
        
        if($insRes){
             $response_array = array(
                'status' => '1',
                'response' => 'Event created successfully',
            );
            echo json_encode($response_array);
            exit;
        }else{
            
            $response_array = array(
                'status' => '0',
                'response' => 'Sorry there is some problem. Please try later',
            );
            echo json_encode($response_array);
            exit;
            
        }
       
    }
    /*************************************/