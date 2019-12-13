<?php
class Calendar_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    var $prefs;

    function callener_pref(){
        
        // $this -> prefs = array(
        //         'start_day'    => 'sunday',
        //         'month_type'   => 'long',
        //         'day_type'     => 'short',
        //         'show_next_prev'  => TRUE,
        //         'next_prev_url'   => base_url() . "index.php/Calender/display"
        //     );
        $prefs = array(
                'start_day'    => 'sunday',
                'month_type'   => 'long',
                'day_type'     => 'short',
                'show_next_prev'  => TRUE,
                'next_prev_url'   => base_url() . "index.php/Calender/display"
            );
            

            $prefs['template'] = '
            {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

            {heading_row_start}<tr>{/heading_row_start}
            
            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
            
            {heading_row_end}</tr>{/heading_row_end}
            
            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td class="weekday">{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}
            
            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td class="day">{/cal_cell_start}

            {cal_cell_content}<div class="num_day">{day}</div><div class="content">{content}</div>{/cal_cell_content}
            {cal_cell_content_today}
                <div class="highlight">{day}</div>
            {/cal_cell_content_today}
            
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
            
            {cal_cell_blank}&nbsp;{/cal_cell_blank}
            
            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}
            
            {table_close}</table>{/table_close}';
            return $prefs;
    }

    function generate($year,$month)
    {
        $prefs = $this->callener_pref();
        // var_dump($prefs);
        // exit;
        $this->load->library("calendar", $prefs);
        
        // $this->add_calendar_data("2019-12-10", "テスト投稿");
        $cal_data = $this->get_calendar_data($year, $month);
        // array(
        //     17 => "Normalday",
        //     25 => "HappyPayment"
        // );
        return $this->calendar->generate($year,$month,$cal_data);
    }


        function get_calendar_data($year, $month){
            // if($this->db->count_all("calendar") > 0){
                $array = array(
                    "year(date)" => $year,
                    "month(date)" => $month
                );
                $query = $this->db->get_where("calendar", $array);
            
                $cal_data = array();
            
                foreach ( $query -> result() as $row ){
                    $cal_data[intval(substr($row->date, 8,2))] = $row -> data;
                }
                // var_dump($cal_data);
                // exit;
                return $cal_data;
            
            
        }

        function add_calendar_data($date, $text){
            if($this->db->select("date") -> from("calendar") ->where("date", $date)->count_all_results()){
                $this->db->where("date", $date)->update("calendar", array(
                    "data" => $text
                ));
            }else{
                $this->db->insert("calendar", array(
                    "date" => $date,
                    "data" => $text
                ));
            }
            
        }






}

    

?>