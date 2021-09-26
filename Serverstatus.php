<?php
/*Todo
if(bs==win){
cpuwin

}else{
cpulinux
}
*/

//Einfach_oli11
//Windows & Linux
function free_disk_space() {
    $bytes = disk_free_space(".");
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);

    echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';
}
//Serverbauer
//Linux
function cpu_work_load() {
    $load = sys_getloadavg();
    $cpuload = $load[0];
    return $cpuload;
}



//IV_Skill
//Windows CPU Auslastung

function _getServerLoadLinuxData()
{
    if (is_readable("/proc/stat"))
    {
        $stats = @file_get_contents("/proc/stat");

        if ($stats !== false)
        {
            $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

            $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
            $stats = explode("\n", $stats);

            foreach ($stats as $statLine)
            {
                $statLineData = explode(" ", trim($statLine));

                if
                (
                    (count($statLineData) >= 5) &&
                    ($statLineData[0] == "cpu")
                )
                {
                    return array(
                        $statLineData[1],
                        $statLineData[2],
                        $statLineData[3],
                        $statLineData[4],
                    );
                }
            }
        }
    }

    return null;
}
function getServerLoad()
{
    $load = null;

    if (stristr(PHP_OS, "win"))
    {
        $cmd = "wmic cpu get loadpercentage /all";
        @exec($cmd, $output);

        if ($output)
        {
            foreach ($output as $line)
            {
                if ($line && preg_match("/^[0-9]+\$/", $line))
                {
                    $load = $line;
                    break;
                }
            }
        }
    }
    else
    {
        if (is_readable("/proc/stat"))
        {
            $statData1 = _getServerLoadLinuxData();
            sleep(1);
            $statData2 = _getServerLoadLinuxData();

            if
            (
                (!is_null($statData1)) &&
                (!is_null($statData2))
            )
            {
                $statData2[0] -= $statData1[0];
                $statData2[1] -= $statData1[1];
                $statData2[2] -= $statData1[2];
                $statData2[3] -= $statData1[3];


                $cpuTime = $statData2[0] + $statData2[1] + $statData2[2] + $statData2[3];

                $load = 100 - ($statData2[3] * 100 / $cpuTime);
            }
        }
    }

    return $load;
}

//----------------------------
function echo_cpu_load() {
    $cpuLoad = getServerLoad();
    if (is_null($cpuLoad)) {
        echo "CPU could not load. Maybe your Windows is too old!";
    } else {
        echo $cpuLoad . "% ";
    }
}

//RAM Auslastung
function getServerMemoryUsage($getPercentage=true)
{
    $memoryTotal = null;
    $memoryFree = null;

    if (stristr(PHP_OS, "win")) {
        $cmd = "wmic ComputerSystem get TotalPhysicalMemory";
        @exec($cmd, $outputTotalPhysicalMemory);
        $cmd = "wmic OS get FreePhysicalMemory";
        @exec($cmd, $outputFreePhysicalMemory);

        if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
            foreach ($outputTotalPhysicalMemory as $line) {
                if ($line && preg_match("/^[0-9]+\$/", $line)) {
                    $memoryTotal = $line;
                    break;
                }
            }

            foreach ($outputFreePhysicalMemory as $line) {
                if ($line && preg_match("/^[0-9]+\$/", $line)) {
                    $memoryFree = $line;
                    $memoryFree *= 1024;
                    break;
                }
            }
        }
    }
    else
    {
        if (is_readable("/proc/meminfo"))
        {
            $stats = @file_get_contents("/proc/meminfo");

            if ($stats !== false) {
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);
                foreach ($stats as $statLine) {
                    $statLineData = explode(":", trim($statLine));
                    if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
                        $memoryTotal = trim($statLineData[1]);
                        $memoryTotal = explode(" ", $memoryTotal);
                        $memoryTotal = $memoryTotal[0];
                        $memoryTotal *= 1024;
                    }


                    if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
                        $memoryFree = trim($statLineData[1]);
                        $memoryFree = explode(" ", $memoryFree);
                        $memoryFree = $memoryFree[0];
                        $memoryFree *= 1024;
                    }
                }
            }
        }
    }

    if (is_null($memoryTotal) || is_null($memoryFree)) {
        return null;
    } else {
        if ($getPercentage) {
            return (100 - ($memoryFree * 100 / $memoryTotal));
        } else {
            return array(
                "total" => $memoryTotal,
                "free" => $memoryFree,
            );
        }
    }
}

function getNiceFileSize($bytes, $binaryPrefix=true) {
    if ($binaryPrefix) {
        $unit=array('B','KiB','MiB','GiB','TiB','PiB');
        if ($bytes==0) return '0 ' . $unit[0];
        return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
    } else {
        $unit=array('B','KB','MB','GB','TB','PB');
        if ($bytes==0) return '0 ' . $unit[0];
        return @round($bytes/pow(1000,($i=floor(log($bytes,1000)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
    }
}





function echo_memory_usage() {
    $mem_usage = memory_get_usage(true);

    if ($mem_usage < 1024)
        echo $mem_usage." bytes";
    elseif ($mem_usage < 1048576)
        echo round($mem_usage/1024,2)." kilobytes";
    else
        echo round($mem_usage/1048576,2)." megabytes";

    echo "<br/>";

    $memUsage = getServerMemoryUsage(false);
    echo sprintf("Memory usage: %s / %s (%s%%)",
        getNiceFileSize($memUsage["total"] - $memUsage["free"]),
        getNiceFileSize($memUsage["total"]),
        getServerMemoryUsage(true));
}

function ping($host, $port, $timeout) {
    $tB = microtime(true);
    $errno=1;
    $errstr="Server is down";
    $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
    if (!$fP) { return "down"; }
    $tA = microtime(true);
    return round((($tA - $tB) * 1000), 0)." ms";

}

?>
