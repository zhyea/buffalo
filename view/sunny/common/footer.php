
<div th:fragment="footer">
    <div class="container footer">
        <div class="col-md-12 col-xs-12 copyright">
            <div th:remove="tag" th:if="${!#strings.isEmpty(bottom_text)}" th:utext="${bottom_text}"></div>
        </div>
    </div>

    <script th:src="@{/static/js/bootstrap.min.js}"></script>
    <script th:src="@{/static/js/custom.js}"></script>

    <div th:remove="tag" th:if="${!#strings.isEmpty(statistic)}" th:utext="${statistic}"></div>
</div>


