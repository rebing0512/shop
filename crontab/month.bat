	@echo off
mshta vbscript:createobject("wscript.shell").run("""iexplore"" http://www.ynlmsc.pw/crontab/cj_index.php?con=month",0)(window.close) 
echo 1
taskkill /f /im iexplore.exe 