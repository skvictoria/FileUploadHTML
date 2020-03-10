# FileUploadHTML

파일을 업로드했을 시 RetinaNet으로 학습시킨 딥러닝 모델 결과 보여줌

(pictures폴더에 사진 임시 저장 후 삭제 -> Storage 폴더에 사진 영구 저장)


## 도커 초기화시키고 나서 동작시켰을 때 손봐야하는 부분

1. pip부터 시작해서 필요한 파이썬 라이브러리 깐다(tensorflow, keras, numpy, matplotlib, PIL, opencv 등)
2. chmod:777 고려
3. php.ini에 file_uploads = On 이 되어있는지 확인한다.
4. php.ini에 uploads_max_filesize가 너무 작진 않은지 확인한다.
