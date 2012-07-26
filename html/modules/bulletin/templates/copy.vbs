Option Explicit
On Error Resume Next

Dim objFSO		  ' FileSystemObject
Dim strTempFolder   ' �ꎞ�t�H���_��
Dim strTempFile	 ' �ꎞ�t�@�C����
Dim objFile	 ' �t�@�C���ǂݍ��ݗp
Dim strFileContet 
Dim strValue	' �z��
Dim strValue2	' �z��
Dim lngLoop     ' ���[�v�J�E���^
Dim lngNum    ' ���͂�������

lngNum = InputBox("�������郂�W���[���̔ԍ�����͂��Ă��������B", "�e���v���[�g�𕡐����܂��B" , "3")

If NOT IsNumeric(lngNum) Then
	WScript.Echo "���l����͂��Ă��������B"
	WScript.Quit
End If

If lngNum = "" Then
	WScript.Echo "�����𒆒f���܂����B"
	WScript.Quit
End If

strValue = Array("rss", "print", "item", "index", "head", "article", "archive")
strValue2 = Array("topics", "new", "comments", "cnew", "bigstory")

Set objFSO = WScript.CreateObject("Scripting.FileSystemObject")

For lngLoop = 0 To UBound(strValue)

	Set objFile = objFSO.OpenTextFile("bulletin_" & strValue(lngLoop) & ".html")

	If Err.Number = 0 Then
		strFileContet = objFile.ReadAll
		' �u������
		strFileContet = Replace(strFileContet, "db:bulletin", "db:bulletin" & lngNum)
'		WScript.Echo strFileContet
		objFile.Close
		If Err.Number = 0 Then
			Set objFile = objFSO.CreateTextFile("bulletin" & lngNum & "_" & strValue(lngLoop) & ".html")
			If Err.Number = 0 Then
				objFile.Write(strFileContet)
				objFile.Close
			Else
				WScript.Echo "�G���[: " & Err.Description
				WScript.Quit
			End If
		Else
			WScript.Echo "�G���[: " & Err.Description
			WScript.Quit
		End If
	Else
		WScript.Echo "�t�@�C���I�[�v���G���[: " & Err.Description
		WScript.Quit
	End If

Next

For lngLoop = 0 To UBound(strValue2)

	Set objFile = objFSO.OpenTextFile("blocks\bulletin_block_" & strValue2(lngLoop) & ".html")

	If Err.Number = 0 Then
		strFileContet = objFile.ReadAll
		' �u������
		strFileContet = Replace(strFileContet, "db:bulletin", "db:bulletin" & lngNum)
'		WScript.Echo strFileContet
		objFile.Close
		If Err.Number = 0 Then
			Set objFile = objFSO.CreateTextFile("blocks\bulletin" & lngNum & "_block_" & strValue2(lngLoop) & ".html")
			If Err.Number = 0 Then
				objFile.Write(strFileContet)
				objFile.Close
			Else
				WScript.Echo "�G���[: " & Err.Description
				WScript.Quit
			End If
		Else
			WScript.Echo "�G���[: " & Err.Description
			WScript.Quit
		End If
	Else
		WScript.Echo "�t�@�C���I�[�v���G���[: " & Err.Description
		WScript.Quit
	End If

Next

Set objFSO = Nothing