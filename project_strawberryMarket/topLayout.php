<!-- top 레이아웃 include -->
<jsp:include page = "/layout/topLayout.jspf" flush = "false"/>

<!-- bottom 레이아웃 include -->
<jsp:include page = "/layout/bottomLayout.jspf" flush = "false"/>

<!DOCTYPE html>
<html lang="en">

<%@page import="login.SessionCheck"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Welcome to Codevang</title>
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<!-- 네비바를 fiexd-top으로 설정했을 때 컨텐츠와 겹치는 문제 방지 -->
<body class="pt-5">

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="/etc">Codevang's Page</a>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a class="nav-link" href="/etc">홈
							<span class="sr-only">(current)</span>
					</a></li>
					<li class="nav-item"><a class="nav-link"
						href="/join/login.jsp">로그인</a></li>
					<li class="nav-item"><a class="nav-link"
						href="/join/register.jsp">회원가입</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">

			<div class="col-lg-3">

				<h3 class="my-4 text-center">Category</h3>
				<div class="list-group mb-4">
					<a class="list-group-item list-group-item-info text-center font-weight-bold">게시판</a>
					<a href="#"
						class="list-group-item list-group-item-action text-center font-weight-bold">일상
						공유</a> <a href="#"
						class="list-group-item list-group-item-action text-center font-weight-bold">코딩
						공유</a>
				</div>

			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9 my-4 mb-4">

				<!-- 여기서부터 본문내용, 이후 코드는 bottomLayout에서 마무리 -->
        
