<?

function redirect_to_gmail() {
	header("Location: http://mail.google.com/a/gasts.com/");
	exit(0);
};

function text_mode() {
	global $ra, $ua;
	header("Content-Type: text/plain\n");
	printf("%s\n", $ra);
	if($ua) {
		printf("%s\n", $ua);
	};
	exit(0);
};

function html_mode() {
	global $ra, $ua;
	header("Content-Type: text/html\n");
	$opensearch = true;
	$output = '';
	if($opensearch) {
		$output .= '<link href="/opensearch.xml" rel="search" title="ii.gs Title" type="application/opensearchdescription+xml" />';
	};
	$output .= sprintf("<H1><A HREF=\"http://whois.arin.net/ui/query.do?xslt=http://whois.arin.net/ui/arin.xsl&flushCache=false&q=%s\">%s</A></H1>%s", $ra, $ra, $ua);
	echo $output;
	exit(0);
};

function smart_mode() {
	global $ua;
	if(false === strpos($ua, "Mozilla")) {
		text_mode();
	} else {
		html_mode();
	};
};

$ua = @$_SERVER["HTTP_USER_AGENT"];
$ra = @$_SERVER["REMOTE_ADDR"];

switch(@$_SERVER['HTTP_HOST']){
	case "mail.gasts.com":
		redirect_to_gmail();
	# case "localhost":
	# case "ii.gs":
	# case "www.ii.gs":
	# case "gasts.com":
	# case "www.gasts.com":
	default:
		smart_mode();
};
