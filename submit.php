<?php
  function conStudent($id){
    $link = "https://mathking.kr/moodle/local/augmented_teacher/students/sendtogpt.php?id={$id}&tb=43200";
    $student = curl_init($link);
    curl_setopt($student, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($student);
  }

  $input = $_POST["msg"];
  
  $api_key = trim(file_get_contents("./apikey.env"));
  $url = 'https://api.openai.com/v1/chat/completions';
  
  $messages = [];
  array_push($messages, array("role"=>"system", "content"=>"너는 학부모 면담 assistant고, 사용자는 무조건 학부모야. 그러니 학부모님들의 질문에 무조건 학생의 정보를 알려줘."));
  $student1 = conStudent(1340);
  array_push($messages, array("role"=>"system", "content"=>"이승헌 학생은 '{$student1}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student2 = conStudent(1521);
  array_push($messages, array("role"=>"system", "content"=>"이도윤 학생은 '{$student2}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student3 = conStudent(1315);
  array_push($messages, array("role"=>"system", "content"=>"박하윤 학생은 '{$student3}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student4 = conStudent(1278);
  array_push($messages, array("role"=>"system", "content"=>"이우필 학생은 '{$student4}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student5 = conStudent(1571);
  array_push($messages, array("role"=>"system", "content"=>"김선우 학생은 '{$student5}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student6 = conStudent(1493);
  array_push($messages, array("role"=>"system", "content"=>"송시욱 학생은 '{$student6}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student7 = conStudent(1311);
  array_push($messages, array("role"=>"system", "content"=>"김민준 학생은 '{$student7}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student8 = conStudent(1359);
  array_push($messages, array("role"=>"system", "content"=>"이현종 학생은 '{$student8}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student9 = conStudent(1352);
  array_push($messages, array("role"=>"system", "content"=>"김재룡 학생은 '{$student9}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student10 = conStudent(1131);
  array_push($messages, array("role"=>"system", "content"=>"하명찬 학생은 '{$student10}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));
  $student11 = conStudent(1501);
  array_push($messages, array("role"=>"system", "content"=>"오태환 학생은 '{$student11}' 해당 내용을 참고해서 최대한 간략하게 정리해서 무조건 알려줘."));

  array_push($messages, array("role"=>"user", "content"=> $input));

  // HTTP 헤더 설정
  $headers = array(
    "Authorization: Bearer ".$api_key,
    "Content-Type: application/json"
  );
  
  // POST 요청으로 보낼 데이터
  $data = array(
    'model'=> 'gpt-4-1106-preview',
    'messages'=> $messages
  );
  
  // cURL 세션 초기화
  $ch = curl_init($url);
  
  // cURL 옵션 설정
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  // 요청 실행 및 응답 받기
  $response = curl_exec($ch);
  
  $result = json_decode($response);
  // cURL 세션 종료
  curl_close($ch);

  // 응답 출력
  echo($result->choices[0]->message->content);
?>