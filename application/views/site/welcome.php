<?php
/**
 * @name welcome.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-2
 * Encoding UTF-8
 */
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" valign="top" background="<?php echo $this->imgUrl;?>mail_leftbg.gif"><img
			src="<?php echo $this->imgUrl;?>left-top-right.gif" width="17" height="29" /></td>
		<td valign="top" background="<?php echo $this->imgUrl;?>content-bg.gif"><table
				width="100%" height="31" border="0" cellpadding="0" cellspacing="0"
				class="left_topbg" id="table2">
				<tr>
					<td height="31"><div class="titlebt">欢迎界面</div></td>
				</tr>
			</table></td>
		<td width="16" valign="top" background="<?php echo $this->imgUrl;?>mail_rightbg.gif"><img
			src="<?php echo $this->imgUrl;?>nav-right-bg.gif" width="16" height="29" /></td>
	</tr>
	<tr>
		<td valign="middle" background="<?php echo $this->imgUrl;?>mail_leftbg.gif">&nbsp;</td>
		<td valign="top" bgcolor="#F7F8F9"><table width="98%" border="0"
				align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2" valign="top">&nbsp;</td>
					<td>&nbsp;</td>
					<td valign="top">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" valign="top">
						<span class="left_bt left_ts">感谢您使用 社区宝管理系统</span><br> <br>
						<span class="left_txt">
							&nbsp;<img src="<?php echo $this->imgUrl;?>ts.gif" width="16" height="16" />说明
						</span>
						<span class="left_txt"><br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;管理您的网站，用户。推送您的通知和广告.<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enjoy! <br>
					</span></td>
					<td width="7%">&nbsp;</td>
					<td width="40%" valign="top"><table width="100%" height="144"
							border="0" cellpadding="0" cellspacing="0" class="line_table">
							<tr>
								<td width="7%" height="27" background="<?php echo $this->imgUrl;?>news-title-bg.gif"><img
									src="<?php echo $this->imgUrl;?>news-title-bg.gif" width="2" height="27"></td>
								<td width="93%" background="<?php echo $this->imgUrl;?>news-title-bg.gif"
									class="left_bt2">最新动态</td>
							</tr>
							<tr>
								<td height="102" valign="top">&nbsp;</td>
								<td height="102" valign="top"></td>
							</tr>
							<tr>
								<td height="5" colspan="2">&nbsp;</td>
							</tr>
						</table></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" valign="top">
						<TABLE width=72% border=0 cellPadding=0 cellSpacing=0 id=secTable>
							<TBODY>
								<TR align=middle height=20>
									<TD align="center" class=sec2 onclick=secBoard(0)>验证信息</TD>
									<TD align="center" class=sec1 onclick=secBoard(1)>统计信息</TD>
									<TD align="center" class=sec1 onclick=secBoard(2)>系统参数</TD>
									<TD align="center" class=sec1 onclick=secBoard(3)>版权说明</TD>
								</TR>
							</TBODY>
						</TABLE>
						<TABLE class=main_tab id=mainTable cellSpacing=0 cellPadding=0
							width=100% border=0>
							<!--关于TBODY标记-->
							<TBODY style="DISPLAY: block">
								<TR>
									<TD vAlign=top align=middle><TABLE width=98% height="133"
											border=0 align="center" cellPadding=0 cellSpacing=0>
											<TBODY>
												<TR>
													<TD height="5" colspan="3"></TD>
												</TR>
												<TR>
													<TD width="4%" height="28"
														background="<?php echo $this->imgUrl;?>news-title-bg.gif"></TD>
													<TD height="25" colspan="2"
														background="<?php echo $this->imgUrl;?>news-title-bg.gif" class="left_txt">亲爱的管理员：
														<font color="#FFFFFF" class="left_ts"><b></b>
													
													</TD>
												</TR>
												<TR>
													<TD bgcolor="#FAFBFC">&nbsp;</TD>
													<TD width="42%" height="25" bgcolor="#FAFBFC"><span
														class="left_txt">您有未验证分类信息： </span> <span class="left_ts">
													</span></TD>
													<TD width="54%" height="25" bgcolor="#FAFBFC"><span
														class="left_txt">您有未验证广告张贴： </span> <span class="left_ts">
													</span></TD>
												</TR>
												<TR>
													<TD bgcolor="#FAFBFC">&nbsp;</TD>
													<TD height="25" bgcolor="#FAFBFC"><span class="left_txt">您有未验证商家展示：
													</span> <span class="left_ts"> </span></TD>
													<TD height="25" bgcolor="#FAFBFC"><span class="left_txt">您有未验证网上商城：
													</span> <span class="left_ts"> </span></TD>
												</TR>
												<TR>
													<TD bgcolor="#FAFBFC">&nbsp;</TD>
													<TD height="25" bgcolor="#FAFBFC"><span class="left_txt">您有未验证网上名片：
													</span> <span class="left_ts"> </span></TD>
													<TD height="25" bgcolor="#FAFBFC"><span class="left_txt">您有未验证市场联盟：
													</span> <span class="left_ts"> </span></TD>
												</TR>
												<TR>
													<TD bgcolor="#FAFBFC">&nbsp;</TD>
													<TD height="25" bgcolor="#FAFBFC"><span class="left_txt">您有未验证市场资讯：
													</span> <span class="left_ts"> </span></TD>
													<TD height="25" bgcolor="#FAFBFC"><span class="left_txt">您有未验证商家商品：
													</span> <span class="left_ts"> </span></TD>
												</TR>
												<TR>
													<TD height="5" colspan="3"></TD>
												</TR>
											</TBODY>
										</TABLE></TD>
								</TR>
							</TBODY>
						</TABLE>
					</td>
					<td>&nbsp;</td>
					<td valign="top"><table width="100%" height="144" border="0"
							cellpadding="0" cellspacing="0" class="line_table">
							<tr>
								<td width="7%" height="27" background="<?php echo $this->imgUrl;?>news-title-bg.gif"><img
									src="<?php echo $this->imgUrl;?>news-title-bg.gif" width="2" height="27"></td>
								<td width="93%" background="<?php echo $this->imgUrl;?>news-title-bg.gif"
									class="left_bt2">程序说明</td>
							</tr>
							<tr>
								<td height="102" valign="top">&nbsp;</td>
								<td height="102" valign="top"><label></label> <label> <textarea
											name="textarea" cols="48" rows="8" class="left_txt">一、专业的地区级商家门户建站首选方案！
二、全站一号通，一次注册，终身使用，一个帐号，全站通用！
三、分类信息、商家展示（百业联盟）、网上商城、网上名片（网上黄页）、广告张贴、市场联盟、市场资讯七大栏目完美整合。
四、界面设计精美，后台功能强大。傻瓜式后台操作，无需专业的网站制作知识，只要会打字，就会管理维护网站。</textarea>
								</label></td>
							</tr>
							<tr>
								<td height="5" colspan="2">&nbsp;</td>
							</tr>
						</table></td>
				</tr>
				<tr>
					<td height="40" colspan="4"><table width="100%" height="1"
							border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
							<tr>
								<td></td>
							</tr>
						</table></td>
				</tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td width="51%" class="left_txt"><img src="<?php echo $this->imgUrl;?>icon-mail2.gif"
						width="16" height="11"> 客户服务邮箱：215288671@qq.com<br> <img
						src="<?php echo $this->imgUrl;?>icon-phone.gif" width="17" height="14">
						官方网站：http://www.865171.cn</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table></td>
		<td background="<?php echo $this->imgUrl;?>mail_rightbg.gif">&nbsp;</td>
	</tr>
	<tr>
		<td valign="bottom" background="<?php echo $this->imgUrl;?>mail_leftbg.gif"><img
			src="<?php echo $this->imgUrl;?>buttom_left2.gif" width="17" height="17" /></td>
		<td background="<?php echo $this->imgUrl;?>buttom_bgs.gif"><img
			src="<?php echo $this->imgUrl;?>buttom_bgs.gif" width="17" height="17"></td>
		<td valign="bottom" background="<?php echo $this->imgUrl;?>mail_rightbg.gif"><img
			src="<?php echo $this->imgUrl;?>buttom_right2.gif" width="16" height="17" /></td>
	</tr>
</table>