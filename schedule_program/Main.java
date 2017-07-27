package challenge;

import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
 
public class Main extends JFrame{
   DatePanel selectedDate = null;
   
   Calendar calendar = new Calendar();
   Container contentPane = getContentPane();
 
   JPanel mainPanel = new MainPanel();
   JPanel subPanel01 = new SubPanel01();
   JPanel subPanel02 = new SubPanel02();
 
   JPanel yearmonthday = new YearMonthDay();
   JPanel yearmonth = new YearMonth();
   JPanel day = new Day();
   JButton btn1;
   JButton btn2;
   JLabel la1;
 
   JPanel cal = new JPanel();
 
   JPanel eventname = new EventName();
   JLabel eventnamelabel01 = new JLabel("이벤트", SwingConstants.CENTER);
   JLabel eventnamelabel02 = new JLabel("2017년 6월", SwingConstants.CENTER);
 
   JPanel titletime = new TitleTime();
   Title title = new Title();
   JPanel timestart = new TimeStart();
   JPanel timeend = new TimeEnd();
 
   JTextField tf;
 
   JPanel memo = new Memo();
   JTextArea ta;
 
   JPanel button = new Button();
   JButton save;
   JButton delete;
 
   Main(){
       setTitle("일정관리");
       setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
       setSize(1000,500);
       //mainPanel.setPreferredSize(new Dimension(1000, 600));
       subPanel01.setPreferredSize(new Dimension(600, 500));
       subPanel02.setPreferredSize(new Dimension(300, 500));
       //contentPane.setPreferredSize(new Dimension(200, 600));
 
       calendar.setCalendar(2017, 6);
       calendar.print();
 
       contentPane.add(mainPanel);
       mainPanel.add(subPanel01);
       mainPanel.add(subPanel02);
 
       subPanel01.add(yearmonthday, BorderLayout.NORTH);
       subPanel01.add(cal, BorderLayout.CENTER);
 
       subPanel02.add(eventname);
       subPanel02.add(titletime);
       subPanel02.add(memo);
       subPanel02.add(button);
 
       yearmonthday.add(yearmonth);
       yearmonthday.add(day);
 
       cal.setLayout(new GridLayout(6, 7));
 
       eventname.add(eventnamelabel01);
       eventname.add(eventnamelabel02);
 
       titletime.add(title);
       titletime.add(timestart);
       titletime.add(timeend);
 
 
       MyMouseListener listener = new MyMouseListener();
       yearmonth.addMouseListener(listener);
       yearmonth.addMouseMotionListener(listener);
 
       btn1.addMouseListener(new MyMouseListener());
       btn2.addMouseListener(new MyMouseListener());
       
       setVisible(true);
   }
 
   class MainPanel extends JPanel{
       MainPanel(){
           setLayout(new FlowLayout());
       }
   }
 
   class SubPanel01 extends JPanel{
       SubPanel01(){
           setLayout(new BorderLayout());
       }
   }
 
   class SubPanel02 extends JPanel{
       SubPanel02(){
           setLayout(new GridLayout(4, 1));
       }
   }
 
   class YearMonthDay extends JPanel{
       YearMonthDay(){
           setLayout(new GridLayout(2, 1));
       }
   }
 
   class YearMonth extends JPanel{
       YearMonth(){
           setLayout(new GridLayout(1, 1));
           btn1 = new JButton("<");
           la1 = new JLabel("2017년 6월", SwingConstants.CENTER);
           btn2 = new JButton(">");
 
           add(btn1);
           add(la1);
           add(btn2);
       }
   }
 
   class Day extends JPanel{
       Day(){
           setLayout(new GridLayout(1, 7));
           JLabel la2 = new JLabel("일", JLabel.CENTER);
           JLabel la3 = new JLabel("월", JLabel.CENTER);
           JLabel la4 = new JLabel("화", JLabel.CENTER);
           JLabel la5 = new JLabel("수", JLabel.CENTER);
           JLabel la6 = new JLabel("목", JLabel.CENTER);
           JLabel la7 = new JLabel("금", JLabel.CENTER);
           JLabel la8 = new JLabel("토", JLabel.CENTER);
 
           add(la2);
           add(la3);
           add(la4);
           add(la5);
           add(la6);
           add(la7);
           add(la8);
       }
   }
 
   class EventName extends JPanel{
       EventName(){
           setLayout(new GridLayout(2, 1));
       }
   }
 
   class TitleTime extends JPanel{
       TitleTime(){
           setLayout(new GridLayout(3, 1));
       }
   }
 
   class Title extends JPanel{
       private JTextField tf = new JTextField();
       Title(){
           setLayout(new FlowLayout());
           this.tf = new JTextField(15);
           JLabel title = new JLabel("제목");
           add(title);
           add(tf);
       }
 
       public void setTitle(String s) {
           tf.setText(s);
           this.revalidate();
           this.repaint();
       }
 
       public String getTitle() {
           return tf.getText();
       }
   }
 
   class TimeStart extends JPanel{
       TimeStart(){
           setLayout(new FlowLayout());
 
           JLabel timestartlabel = new JLabel("시작");
 
           String hour1[] = new String[24];
           for(int i = 0; i<24; i++){
               String text = Integer.toString(i);
               hour1[i] = text;
           }
 
           String min1[] = new String[60];
           for(int i = 0; i<60; i++){
               String text = Integer.toString(i);
               min1[i] = text;
           }
 
           String sec1[] = new String[60];
           for(int i = 0; i<60; i++){
               String text = Integer.toString(i);
               sec1[i] = text;
           }
 
           JComboBox combo1 = new JComboBox<String>(hour1);
           JComboBox combo2 = new JComboBox<String>(min1);
           JComboBox combo3 = new JComboBox<String>(sec1);
 
           add(timestartlabel);
           add(combo1);
           add(combo2);
           add(combo3);
       }
   }
 
   class TimeEnd extends JPanel{
       TimeEnd(){
           setLayout(new FlowLayout());
 
           JLabel timeendlabel = new JLabel("종료");
 
           String hour2[] = new String[24];
           for(int i = 0; i<24; i++){
               String text = Integer.toString(i);
               hour2[i] = text;
           }
 
           String min2[] = new String[60];
           for(int i = 0; i<60; i++){
               String text = Integer.toString(i);
               min2[i] = text;
           }
 
           String sec2[] = new String[60];
           for(int i = 0; i<60; i++){
               String text = Integer.toString(i);
               sec2[i] = text;
           }
 
           JComboBox combo4 = new JComboBox<String>(hour2);
           JComboBox combo5 = new JComboBox<String>(min2);
           JComboBox combo6 = new JComboBox<String>(sec2);
 
           add(timeendlabel);
           add(combo4);
           add(combo5);
           add(combo6);
       }
   }
 
   class Memo extends JPanel{
       Memo(){
           setLayout(new FlowLayout());
 
           JLabel memolabel = new JLabel("메모");
           ta = new JTextArea("", 5, 15);
 
           add(memolabel);
           add(ta);
           add(new JScrollPane(ta));
       }
   }
 
   class Button extends JPanel{
       Button(){
           setLayout(new FlowLayout());
 
           save = new JButton("저장");
           save.setHorizontalAlignment(SwingConstants.CENTER);
           save.setVerticalAlignment(SwingConstants.CENTER);
           save.addMouseListener(new btnListener());
 
           delete = new JButton("삭제");
           delete.setHorizontalAlignment(SwingConstants.CENTER);
           delete.setVerticalAlignment(SwingConstants.CENTER);
           delete.addMouseListener(new btnListener());
 
           add(save);
           add(delete);
       }
   }
 
   static class CalendarUtil {
       public static int calDays(int year, int month, int day) {
           int[] months = {31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31};
           int total_days = 0;
           total_days += (year - 1) * 365;
           total_days += year / 4 - year / 100 + year / 400;
           if (((year % 4 == 0 && year % 100 != 0) || (year % 400 == 0)) &&
                   (month <= 2))
               total_days--;
           for (int i = 0; i < month - 1; i++)
               total_days += months[i];
           total_days += day;
           return total_days;
       }
 
       public static int calcLastDay(int year, int month) {
           int[] months = {31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31};
           int day = 1;
 
           if (month != 2)
               day = months[month - 1];
           else if ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0)
               day = months[month - 1] + 1;
           return day;
       }
   }
 
   public class Calendar{
       static final int DAYS_OF_WEEK = 7;
       static final int WEAKS_OF_MONTH = 6;
 
       protected int[][] calArray;
 
       int year = 2017 ;
       int month = 6;
       int day;
 
       public Calendar() {
           year = month = day = 0;
           calArray = new int[WEAKS_OF_MONTH][DAYS_OF_WEEK];
       }
 
       public void setCalendar(int year, int month) {
           this.year = year;
           this.month = month;
           this.day = 0;
           makeCalendar(year,month);
       }
 
       public void setCalendar(int year, int month, int day) {
           setCalendar(year,month);
           this.day = day;
 
       }
 
       public void makeCalendar(int year, int month) {
           initCalArray();
           int total_days = CalendarUtil.calDays(year, month, 1);
           int dayOfWeek = total_days % 7;
           int lastDay = CalendarUtil.calcLastDay(year, month);
           setCalArray(dayOfWeek, lastDay);
       }
 
       public void initCalArray() {
           for (int i = 0; i < WEAKS_OF_MONTH; i++)
               for (int j = 0; j < DAYS_OF_WEEK; j++)
                   calArray[i][j] =0;
       }
 
       public void setCalArray(int startDayOfWeek, int lastDay) {
           int day = 1;
           for (int i = 0; i < WEAKS_OF_MONTH; i++) {
               for (int j = startDayOfWeek; j < DAYS_OF_WEEK; j++) {
                   calArray[i][j] = day++;
                   if (day > lastDay) return;
               }
               if (i == 0) startDayOfWeek = 0;
           }
       }
 
       public void print() {
           System.out.printf("%4d 년 %2d 월\n", year,month);
           System.out.printf("%3s%5s%5s%5s%5s%5s%5s\n", "SUN", "MON", "TUE", "WED", "THR", "FRI", "SAT");
           for (int i = 0; i < WEAKS_OF_MONTH; i++) {
               for (int j = 0; j < DAYS_OF_WEEK; j++) {
                   printDate(calArray[i][j]);
               }
               System.out.println();
           }
       }
 
       public void printDate(int date) {
           if (date >= 1 && date <= 31) {
               if (date == day){
                   System.out.printf("%2d%s%2s", date,"*","");
               }
 
               else{
                   System.out.printf("%2d%3s", date, "");
                   String text = Integer.toString(date);
 
                   DatePanel datePanel = new DatePanel(text);
                   datePanel.addMouseListener(new DatePanelListener());
 
                   cal.add(datePanel);
               }
           }
 
           else {
               JPanel emtpyPanel = new JPanel();
               cal.add(emtpyPanel);
           }
       }
   }
   
   class btnListener extends MouseAdapter {
       @Override
       public void mousePressed(MouseEvent e) {
           super.mousePressed(e);
           if(e.getSource() == save) {
               if (selectedDate != null) {
                   System.out.printf("selected is not null");
                   selectedDate.setEventTitle(title.getTitle());
                   selectedDate.setMemo(ta.getText());
                   title.setTitle("");
                   ta.setText("");
               }
               else {
                   System.out.printf("selected is null");
               }
           }
           else {
               if (selectedDate != null) {
                   selectedDate.setEventTitle("");
                   selectedDate.setMemo("");
                   title.setTitle("");
                   ta.setText("");
               }
               else {
 
               }
           }
       }
   }
 
   public class DatePanelListener extends MouseAdapter{
       public void mousePressed(MouseEvent e){
           if(selectedDate != null){
               selectedDate.setBackground(new Color(238, 238, 238));
           }
           System.out.print("Click\n");
           selectedDate = (DatePanel)e.getSource();
           title.setTitle(selectedDate.getEventTitle());
           ta.setText(selectedDate.getMemo());
           selectedDate.setBackground(Color.YELLOW);
       }
   }
   
   int i=0;
   public class MyMouseListener extends MouseAdapter {
       @Override
       public void mousePressed(MouseEvent e) {
           if (e.getSource().equals(btn1)){
               yearmonth.removeAll();
               cal.removeAll();
               eventname.removeAll();
 
               if(i==0){
                   calendar.month=6;
                   calendar.year=2017;
                   i++;
               }
 
               if(i==1){
                   if(calendar.month  == 1){
                       calendar.year -= 1;
                       calendar.month = 13;
                   }
               }
 
               calendar.month-=1;
               JLabel la1 = new JLabel(calendar.year + "년 " + calendar.month + "월", JLabel.CENTER);
               JLabel eventnamelabel02 = new JLabel(calendar.year + "년 " + calendar.month + "월", JLabel.CENTER);
               calendar.setCalendar(calendar.year, calendar.month);
               yearmonth.add(btn1);
               yearmonth.add(la1);
               yearmonth.add(btn2);
 
               eventname.add(eventnamelabel01);
               eventname.add(eventnamelabel02);
               calendar.print();
 
               revalidate();
               repaint();
           }
           if(e.getSource().equals(btn2)){
               yearmonth.removeAll();
               cal.removeAll();
               eventname.removeAll();
 
               if(i==0){
                   calendar.month=6;
                   calendar.year=2017;
                   i++;
               }
               if(i==1){
                   if(calendar.month % 12 == 0){
                       calendar.year += 1;
                       calendar.month =0;
                   }
               }
 
               calendar.month+=1;
               JLabel la1 = new JLabel(calendar.year + "년 " + calendar.month + "월", JLabel.CENTER);
               JLabel eventnamelabel02 = new JLabel(calendar.year + "년 " + calendar.month + "월", JLabel.CENTER);
               calendar.setCalendar(calendar.year, calendar.month);
               yearmonth.add(btn1);
               yearmonth.add(la1);
               yearmonth.add(btn2);
 
               eventname.add(eventnamelabel01);
               eventname.add(eventnamelabel02);
               calendar.print();
 
               revalidate();
               repaint();
           }
       }
   }
 
   public static void main(String[] args) {
       new Main();
   }
}
 
 
 
 
 
