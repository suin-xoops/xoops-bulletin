Option Explicit
On Error Resume Next

Dim objFSO		  ' FileSystemObject
Dim strTempFolder   ' 一時フォルダ名
Dim strTempFile	 ' 一時ファイル名
Dim objFile	 ' ファイル読み込み用
Dim strFileContet 
Dim strValue	' 配列
Dim strValue2	' 配列
Dim lngLoop     ' ループカウンタ
Dim lngNum    ' 入力した数字

lngNum = InputBox("複製するモジュールの番号を入力してください。", "テンプレートを複製します。" , "3")

If NOT IsNumeric(lngNum) Then
	WScript.Echo "数値を入力してください。"
	WScript.Quit
End If

If lngNum = "" Then
	WScript.Echo "処理を中断しました。"
	WScript.Quit
End If

strValue = Array("rss", "print", "item", "index", "head", "article", "archive")
strValue2 = Array("topics", "new", "comments", "cnew", "bigstory")

Set objFSO = WScript.CreateObject("Scripting.FileSystemObject")

For lngLoop = 0 To UBound(strValue)

	Set objFile = objFSO.OpenTextFile("bulletin_" & strValue(lngLoop) & ".html")

	If Err.Number = 0 Then
		strFileContet = objFile.ReadAll
		' 置換処理
		strFileContet = Replace(strFileContet, "db:bulletin", "db:bulletin" & lngNum)
'		WScript.Echo strFileContet
		objFile.Close
		If Err.Number = 0 Then
			Set objFile = objFSO.CreateTextFile("bulletin" & lngNum & "_" & strValue(lngLoop) & ".html")
			If Err.Number = 0 Then
				objFile.Write(strFileContet)
				objFile.Close
			Else
				WScript.Echo "エラー: " & Err.Description
				WScript.Quit
			End If
		Else
			WScript.Echo "エラー: " & Err.Description
			WScript.Quit
		End If
	Else
		WScript.Echo "ファイルオープンエラー: " & Err.Description
		WScript.Quit
	End If

Next

For lngLoop = 0 To UBound(strValue2)

	Set objFile = objFSO.OpenTextFile("blocks\bulletin_block_" & strValue2(lngLoop) & ".html")

	If Err.Number = 0 Then
		strFileContet = objFile.ReadAll
		' 置換処理
		strFileContet = Replace(strFileContet, "db:bulletin", "db:bulletin" & lngNum)
'		WScript.Echo strFileContet
		objFile.Close
		If Err.Number = 0 Then
			Set objFile = objFSO.CreateTextFile("blocks\bulletin" & lngNum & "_block_" & strValue2(lngLoop) & ".html")
			If Err.Number = 0 Then
				objFile.Write(strFileContet)
				objFile.Close
			Else
				WScript.Echo "エラー: " & Err.Description
				WScript.Quit
			End If
		Else
			WScript.Echo "エラー: " & Err.Description
			WScript.Quit
		End If
	Else
		WScript.Echo "ファイルオープンエラー: " & Err.Description
		WScript.Quit
	End If

Next

Set objFSO = Nothing