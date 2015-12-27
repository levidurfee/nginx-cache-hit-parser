<?php namespace levidurfee;

class fcgiCacheAnalyze {
	protected $lines;
	public function __construct($file) {
		$log = file_get_contents($file);
		$this->lines = explode("\n", $log);
	}

	public function analyze() {
		$pages = [];
		for($i=0;$i<count($this->lines) - 1;$i++) {
			$line = explode(" ", $this->lines[$i]);
			if($line[2] == "-") {
				$line[2] = 'MISS';
			}
			if(isset($pages[$line[1]][$line[2]])) {
				$pages[ $line[1] ] [ $line[2] ]++;		
			} else {
				$pages[ $line[1] ] [ $line[2] ] = 1;
			}
			$pages[ $line[1] ] ['size'] = $line[3];
			if($line[2] == "MISS") {
				$pages[ $line[1] ] ['time'] = $line[4];
			}
		}
		$mask = "| %-20.20s | %-5.5s | %-5.5s | %-5.5s | %-5.5s | %-5.5s\n";
		printf($mask, 'Page', 'HITS', 'MISS', 'EXPIRED', 'TIME', 'RATIO');
		foreach($pages as $page => $value) {
			$total = $pages[$page]['HIT'] + $pages[$page]['MISS'];
			if(isset($pages[$page]['EXPIRED'])) {
				$total = $total + $pages[$page]['EXPIRED'];
			} else {
				$pages[$page]['EXPIRED'] = 0;
			}
			$ratio = ($pages[$page]['HIT'] / $total) * 100;
			printf($mask, $page, $pages[$page]['HIT'], $pages[$page]['MISS'], 
				$pages[$page]['EXPIRED'], $pages[$page]['time'], $ratio);
		}
		return true;
	}
}
